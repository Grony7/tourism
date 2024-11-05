<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Tourist;
use app\models\Accommodation;
use app\models\Cargo;
use yii\helpers\ArrayHelper;
use app\models\TouristGroup;
use app\models\Hotel;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
use yii\base\DynamicModel;
use yii\db\Query;
use app\models\Flight;




class TablesController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTourist()
    {
        $searchModel = new DynamicModel([
            'gender', 'trip_purpose', 'has_children', 'group_id'
        ]);
        $searchModel->addRule(['gender', 'trip_purpose', 'has_children', 'group_id'], 'safe');
        $searchModel->addRule('gender', 'in', ['range' => ['Мужской', 'Женский']]);
        $searchModel->addRule('trip_purpose', 'in', ['range' => ['Отдых', 'Шопинг']]);
        $searchModel->addRule('has_children', 'boolean');
        $searchModel->addRule('group_id', 'integer');

        $query = Tourist::find()
            ->joinWith('group');

        if ($searchModel->load(Yii::$app->request->get())) {
            if (!empty($searchModel->gender)) {
                $query->andFilterWhere(['gender' => $searchModel->gender]);
            }
            if (!empty($searchModel->trip_purpose)) {
                $query->andFilterWhere(['trip_purpose' => $searchModel->trip_purpose]);
            }
            if ($searchModel->has_children !== null && $searchModel->has_children !== '') {
                $query->andFilterWhere(['has_children' => $searchModel->has_children]);
            }
            if (!empty($searchModel->group_id)) {
                $query->andFilterWhere(['group_id' => $searchModel->group_id]);
            }
        }

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $tourists = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $groups = TouristGroup::find()->select(['group_name', 'id'])->indexBy('id')->column();

        return $this->render('tourist/index', [
            'tourists' => $tourists,
            'pagination' => $pagination,
            'searchModel' => $searchModel,
            'groups' => $groups,
        ]);
    }



    public function actionAccommodation()
    {
        $searchModel = new DynamicModel([
            'hotel_id', 'trip_purpose'
        ]);
        $searchModel->addRule(['hotel_id'], 'integer');
        $searchModel->addRule(['trip_purpose'], 'string');

        $query = (new \yii\db\Query())
            ->select([
                'tourist.id AS tourist_id',
                'CONCAT(tourist.surname, " ", tourist.name, " ", tourist.patronymic) AS full_name',
                'accommodation.check_in_date',
                'accommodation.check_out_date',
                'hotel.hotel_name',
                'accommodation.room_number',
                'tourist.trip_purpose',
                'tg.arrival_date',
                'tg.departure_date'
            ])
            ->from('accommodation')
            ->innerJoin('tourist', 'accommodation.tourist_id = tourist.id')
            ->leftJoin('touristgroup tg', 'tourist.group_id = tg.id') // Прямое соединение с group_id
            ->leftJoin('hotel', 'accommodation.hotel_id = hotel.id')
            ->groupBy([
                'accommodation.id',
                'hotel.hotel_name',
                'tourist.id',
                'tourist.trip_purpose',
                'accommodation.check_in_date',
                'accommodation.check_out_date',
                'accommodation.room_number',
                'tg.arrival_date',
                'tg.departure_date'
            ]);

        if ($searchModel->load(Yii::$app->request->get()) && $searchModel->validate()) {
            if (!empty($searchModel->hotel_id)) {
                $query->andFilterWhere(['accommodation.hotel_id' => $searchModel->hotel_id]);
            }
            if (!empty($searchModel->trip_purpose)) {
                $query->andFilterWhere(['tourist.trip_purpose' => $searchModel->trip_purpose]);
            }
        }

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $accommodations = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $hotels = Hotel::find()->select(['hotel_name', 'id'])->indexBy('id')->column();

        return $this->render('accommodation/index', [
            'accommodations' => $accommodations,
            'pagination' => $pagination,
            'searchModel' => $searchModel,
            'hotels' => $hotels,
        ]);
    }

    public function actionCreate($table)
    {
        switch ($table) {
            case 'tourist':
                $model = new Tourist();
                $groupMembership = new GroupMembership();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    $groupMembership->tourist_id = $model->id;
                    $groupMembership->trip_purpose = Yii::$app->request->post('GroupMembership')['trip_purpose']; // Изменено
                    $groupMembership->group_id = Yii::$app->request->post('GroupMembership')['group_id'];
                    $groupMembership->save();

                    Yii::$app->session->setFlash('success', 'Турист успешно добавлен!');
                    return $this->redirect(['tourist']);
                }

                $groups = ArrayHelper::map(TouristGroup::find()->all(), 'id', 'group_name');

                return $this->render('tourist/create', [
                    'model' => $model,
                    'groupMembership' => $groupMembership,
                    'groups' => $groups,
                ]);
                break;

            case 'accommodation':
                $model = new Accommodation();
                $tourists = ArrayHelper::map(Tourist::find()->all(), 'id', function ($model) {
                    return $model->surname . ' ' . $model->name . ' ' . $model->patronymic;
                });
                $hotels = ArrayHelper::map(Hotel::find()->all(), 'id', 'hotel_name');

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    Yii::$app->session->setFlash('success', 'Расселение успешно добавлено!');
                    return $this->redirect(['tables/accommodation']);
                }

                return $this->render('create', [
                    'model' => $model,
                    'tourists' => $tourists,
                    'hotels' => $hotels,
                ]);
                break;

            default:
                throw new NotFoundHttpException("Страница не найдена.");
        }
    }

    public function actionCountryVisitors()
    {
        $searchModel = new DynamicModel(['country', 'trip_purpose', 'start_date', 'end_date']);
        $searchModel->addRule(['country', 'trip_purpose', 'start_date', 'end_date'], 'safe');

        $query = (new Query())
            ->select([
                'tg.country',
                't.id AS tourist_id',
                'CONCAT(t.surname, " ", t.name, " ", t.patronymic) AS full_name',
                't.trip_purpose',
                'tg.arrival_date',
                'tg.departure_date',
            ])
            ->from('tourist t')
            ->leftJoin('touristgroup tg', 't.group_id = tg.id')
            ->orderBy(['tg.arrival_date' => SORT_ASC]);

        if ($searchModel->load(Yii::$app->request->get()) && $searchModel->validate()) {
            if (!empty($searchModel->country)) {
                $query->andFilterWhere(['tg.country' => $searchModel->country]);
            }
            if (!empty($searchModel->trip_purpose)) {
                $query->andFilterWhere(['t.trip_purpose' => $searchModel->trip_purpose]);
            }
            if (!empty($searchModel->start_date)) {
                $query->andFilterWhere(['>=', 'tg.arrival_date', $searchModel->start_date]);
            }
            if (!empty($searchModel->end_date)) {
                $query->andFilterWhere(['<=', 'tg.departure_date', $searchModel->end_date]);
            }
        }

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $visitors = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $totalVisitorsCount = $query->count();

        $countries = ArrayHelper::map(TouristGroup::find()->select(['country'])->distinct()->all(), 'country', 'country');
        $tripPurposes = ['Отдых' => 'Отдых', 'Шопинг' => 'Шопинг'];

        return $this->render('country-visitors', [
            'visitors' => $visitors,
            'pagination' => $pagination,
            'searchModel' => $searchModel,
            'countries' => $countries,
            'tripPurposes' => $tripPurposes,
            'totalVisitorsCount' => $totalVisitorsCount,
        ]);
    }

    public function actionTouristDetails($name, $surname, $patronymic, $birth_date)
    {
        $touristIds = (new Query())
            ->select('id')
            ->from('tourist')
            ->where([
                'name' => $name,
                'surname' => $surname,
                'patronymic' => $patronymic,
                'birth_date' => $birth_date,
            ])
            ->column();

        if (empty($touristIds)) {
            throw new NotFoundHttpException("Турист не найден.");
        }

        $countryVisits = (new Query())
            ->select([
                'tg.country',
                'visit_count' => 'COUNT(DISTINCT tg.id)',
                'arrival_dates' => 'GROUP_CONCAT(DISTINCT tg.arrival_date ORDER BY tg.arrival_date ASC)',
                'departure_dates' => 'GROUP_CONCAT(DISTINCT tg.departure_date ORDER BY tg.departure_date ASC)',
            ])
            ->from('touristgroup tg')
            ->innerJoin('tourist t', 't.group_id = tg.id')
            ->where(['t.id' => $touristIds])
            ->groupBy('tg.country')
            ->all();

        $hotels = (new Query())
            ->select([
                'tg.country',
                'hotel_name' => 'hotel.hotel_name',
                'check_in_dates' => 'GROUP_CONCAT(DISTINCT accommodation.check_in_date ORDER BY accommodation.check_in_date ASC)',
                'check_out_dates' => 'GROUP_CONCAT(DISTINCT accommodation.check_out_date ORDER BY accommodation.check_out_date ASC)',
            ])
            ->from('accommodation')
            ->innerJoin('tourist t', 'accommodation.tourist_id = t.id')
            ->leftJoin('hotel', 'accommodation.hotel_id = hotel.id')
            ->leftJoin('touristgroup tg', 't.group_id = tg.id')
            ->where(['t.id' => $touristIds])
            ->groupBy(['tg.country', 'hotel.hotel_name'])
            ->all();

        $excursions = (new Query())
            ->select([
                'tg.country',
                'excursion_name' => 'excursion.excursion_name',
                'excursion_agency' => 'excursionagency.agency_name',
            ])
            ->from('excursionbooking')
            ->innerJoin('tourist t', 'excursionbooking.tourist_id = t.id')
            ->leftJoin('excursion', 'excursionbooking.excursion_id = excursion.id')
            ->leftJoin('excursionagency', 'excursion.agency_id = excursionagency.id')
            ->leftJoin('touristgroup tg', 't.group_id = tg.id')
            ->where(['t.id' => $touristIds])
            ->groupBy(['tg.country', 'excursion.excursion_name', 'excursionagency.agency_name'])
            ->all();

        $cargo = (new Query())
            ->select([
                'tg.country',
                'cargo_markings' => 'cargo.markings',
                'cargo_pieces' => 'cargo.number_of_pieces',
                'cargo_weight' => 'cargo.weight',
            ])
            ->from('cargo')
            ->innerJoin('tourist t', 'cargo.tourist_id = t.id')
            ->leftJoin('touristgroup tg', 't.group_id = tg.id')
            ->where(['t.id' => $touristIds])
            ->groupBy(['tg.country', 'cargo.markings', 'cargo.number_of_pieces', 'cargo.weight'])
            ->all();

        return $this->render('tourist-details', [
            'name' => $name,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'birth_date' => $birth_date,
            'countryVisits' => $countryVisits,
            'hotels' => $hotels,
            'excursions' => $excursions,
            'cargo' => $cargo,
        ]);
    }

    public function actionSelectTourist()
    {
        $tourists = (new Query())
            ->select([
                'MIN(id) AS id',
                'name',
                'surname',
                'patronymic',
                'birth_date',
                "CONCAT(surname, ' ', name, ' ', patronymic, ' (', DATE_FORMAT(birth_date, '%d.%m.%Y'), ')') AS full_name"
            ])
            ->from('tourist')
            ->groupBy(['name', 'surname', 'patronymic', 'birth_date'])
            ->all();

        return $this->render('select-tourist', [
            'tourists' => $tourists,
        ]);
    }

    public function actionHotelOccupancy()
    {
        $request = Yii::$app->request;
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');

        if (empty($startDate) || empty($endDate)) {
            $dateRange = (new Query())
                ->select(['MIN(check_in_date) AS min_date', 'MAX(check_out_date) AS max_date'])
                ->from('accommodation')
                ->one();

            $startDate = $startDate ?: $dateRange['min_date'];
            $endDate = $endDate ?: $dateRange['max_date'];
        }

        $occupancyData = (new Query())
            ->select([
                'hotel.hotel_name',
                'COUNT(DISTINCT accommodation.room_number) AS occupied_rooms',
                'COUNT(accommodation.tourist_id) AS tourists_count'
            ])
            ->from('accommodation')
            ->innerJoin('hotel', 'accommodation.hotel_id = hotel.id')
            ->where(['between', 'accommodation.check_in_date', $startDate, $endDate])
            ->orWhere(['between', 'accommodation.check_out_date', $startDate, $endDate])
            ->groupBy('hotel.hotel_name')
            ->all();

        return $this->render('hotel-occupancy', [
            'occupancyData' => $occupancyData,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function actionExcursionTouristsCount()
    {
        $request = Yii::$app->request;
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');

        if (empty($startDate) || empty($endDate)) {
            $dateRange = (new Query())
                ->select(['MIN(booking_date) AS min_date', 'MAX(booking_date) AS max_date'])
                ->from('excursionbooking')
                ->one();

            $startDate = $startDate ?: $dateRange['min_date'];
            $endDate = $endDate ?: $dateRange['max_date'];
        }

        $touristData = (new Query())
            ->select([
                't.id AS tourist_id',
                't.name',
                't.surname',
                't.patronymic',
                'e.excursion_name',
                'eb.booking_date',
                'ea.agency_name AS agency'
            ])
            ->from('excursionbooking eb')
            ->innerJoin('tourist t', 'eb.tourist_id = t.id')
            ->innerJoin('excursion e', 'eb.excursion_id = e.id')
            ->innerJoin('excursionagency ea', 'e.agency_id = ea.id')
            ->where(['between', 'eb.booking_date', $startDate, $endDate])
            ->all();

        return $this->render('excursion-tourists-count', [
            'touristData' => $touristData,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function actionTopExcursionsAndAgencies()
    {
        $request = Yii::$app->request;
        $filter = $request->get('filter', 'popularity');

        $query = new Query();

        if ($filter === 'popularity') {
            $data = $query
                ->select([
                    'e.excursion_name',
                    'ea.agency_name',
                    'ea.rating',
                    'COUNT(eb.id) AS booking_count'
                ])
                ->from('excursionbooking eb')
                ->innerJoin('excursion e', 'eb.excursion_id = e.id')
                ->innerJoin('excursionagency ea', 'e.agency_id = ea.id')
                ->groupBy(['e.id', 'ea.id'])
                ->orderBy(['booking_count' => SORT_DESC])
                ->all();
        } else {
            $data = $query
                ->select([
                    'ea.agency_name',
                    'ea.rating',
                    'GROUP_CONCAT(e.excursion_name SEPARATOR ", ") AS excursions'
                ])
                ->from('excursionagency ea')
                ->leftJoin('excursion e', 'e.agency_id = ea.id')
                ->groupBy(['ea.id'])
                ->orderBy(['ea.rating' => SORT_DESC])
                ->all();
        }

        return $this->render('top-excursions-and-agencies', [
            'data' => $data,
            'filter' => $filter,
        ]);
    }


    public function actionFlightLoad()
    {
        $request = Yii::$app->request;
        $flightId = $request->get('flight_id');
        $flightDate = $request->get('flight_date');

        $query = (new Query())
            ->select([
                'f.flight_number',
                'f.flight_date',
                'COUNT(tf.id) AS total_seats',
                'SUM(cargo.weight) AS total_weight',
                'SUM(cargo.volume_weight) AS total_volume_weight',
            ])
            ->from('flight f')
            ->leftJoin('touristflight tf', 'tf.flight_id = f.id')
            ->leftJoin('flightcargo fc', 'fc.flight_id = f.id')
            ->leftJoin('cargo', 'cargo.id = fc.cargo_id')
            ->groupBy(['f.id', 'f.flight_date'])
            ->orderBy(['f.flight_date' => SORT_DESC]);

        if ($flightId) {
            $query->andWhere(['f.id' => $flightId]);
        }
        if ($flightDate) {
            $query->andWhere(['f.flight_date' => $flightDate]);
        }

        $data = $query->all();


        $flights = (new Query())
            ->select(['id', 'flight_number'])
            ->from('flight')
            ->all();

        return $this->render('flight-load', [
            'data' => $data,
            'flightId' => $flightId,
            'flightDate' => $flightDate,
            'flights' => $flights,
        ]);
    }

    public function actionWarehouseStatistics()
    {
        $request = Yii::$app->request;
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = (new Query())
            ->select([
                'SUM(cargo.number_of_pieces) AS total_pieces',
                'SUM(cargo.weight) AS total_weight',
                'COUNT(DISTINCT flightcargo.flight_id) AS total_flights',
                'SUM(CASE WHEN flight.type = "грузовой" THEN 1 ELSE 0 END) AS cargo_flights',
                'SUM(CASE WHEN flight.type = "грузопассажирский" THEN 1 ELSE 0 END) AS cargo_passenger_flights'
            ])
            ->from('warehouserecord')
            ->innerJoin('cargo', 'warehouserecord.cargo_id = cargo.id')
            ->innerJoin('flightcargo', 'cargo.id = flightcargo.cargo_id')
            ->innerJoin('flight', 'flightcargo.flight_id = flight.id')
            ->andFilterWhere(['>=', 'warehouserecord.date_received', $startDate])
            ->andFilterWhere(['<=', 'warehouserecord.date_received', $endDate])
            ->one();

        return $this->render('warehouse-statistics', [
            'query' => $query,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function actionFinancialReport($group_id = null)
    {
        $query = (new Query())
            ->select([
                'report_date' => 'fi.report_date',
                'category' => 'fi.category',
                'amount' => 'fi.amount',
                'item_type' => 'fi.item_type'
            ])
            ->from(['fi' => 'financialitem'])
            ->andFilterWhere(['fi.group_id' => $group_id])
            ->orderBy(['fi.report_date' => SORT_ASC]);

        $financialReport = $query->all();

        $totalIncome = array_sum(array_column(array_filter($financialReport, function($item) {
            return $item['item_type'] === 'Доход';
        }), 'amount'));

        $totalExpense = array_sum(array_column(array_filter($financialReport, function($item) {
            return $item['item_type'] === 'Расход';
        }), 'amount'));

        $totalProfit = $totalIncome - $totalExpense;

        $groups = TouristGroup::find()->select(['id', 'group_name'])->asArray()->all();

        return $this->render('financial-report', [
            'financialReport' => $financialReport,
            'groups' => $groups,
            'group_id' => $group_id,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'totalProfit' => $totalProfit,
        ]);
    }

    public function actionFinancialPeriodReport($startDate = null, $endDate = null)
    {
        $query = (new Query())
            ->select([
                'report_date' => 'fi.report_date',
                'category' => 'fi.category',
                'amount' => 'fi.amount',
                'item_type' => 'fi.item_type'
            ])
            ->from(['fi' => 'financialitem'])
            ->andFilterWhere(['>=', 'fi.report_date', $startDate])
            ->andFilterWhere(['<=', 'fi.report_date', $endDate])
            ->orderBy(['fi.report_date' => SORT_ASC]);

        $financialItems = $query->all();

        $incomeByCategory = [];
        $expenseByCategory = [];

        foreach ($financialItems as $item) {
            if ($item['item_type'] === 'Доход') {
                if (!isset($incomeByCategory[$item['category']])) {
                    $incomeByCategory[$item['category']] = 0;
                }
                $incomeByCategory[$item['category']] += $item['amount'];
            } elseif ($item['item_type'] === 'Расход') {
                if (!isset($expenseByCategory[$item['category']])) {
                    $expenseByCategory[$item['category']] = 0;
                }
                $expenseByCategory[$item['category']] += $item['amount'];
            }
        }

        $totalIncome = array_sum($incomeByCategory);
        $totalExpense = array_sum($expenseByCategory);
        $totalProfit = $totalIncome - $totalExpense;

        return $this->render('financial-period-report', [
            'financialItems' => $financialItems,
            'incomeByCategory' => $incomeByCategory,
            'expenseByCategory' => $expenseByCategory,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'totalProfit' => $totalProfit,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function actionCargoStatistics()
    {
        $query = (new Query())
            ->select([
                'type' => 'c.markings',
                'total_weight' => 'SUM(c.weight)',
                'total_volume_weight' => 'SUM(c.volume_weight)'
            ])
            ->from(['c' => 'cargo'])
            ->groupBy('c.markings');

        $cargoStatistics = $query->all();

        $totalWeight = array_sum(array_column($cargoStatistics, 'total_weight'));
        $totalVolumeWeight = array_sum(array_column($cargoStatistics, 'total_volume_weight'));

        foreach ($cargoStatistics as &$cargo) {
            $cargo['weight_percentage'] = $totalWeight ? round(($cargo['total_weight'] / $totalWeight) * 100, 2) : 0;
            $cargo['volume_percentage'] = $totalVolumeWeight ? round(($cargo['total_volume_weight'] / $totalVolumeWeight) * 100, 2) : 0;
        }
        unset($cargo);

        return $this->render('cargo-statistics', [
            'cargoStatistics' => $cargoStatistics,
            'totalWeight' => $totalWeight,
            'totalVolumeWeight' => $totalVolumeWeight,
        ]);
    }

    public function actionRepresentationalProfitability($startDate = null, $endDate = null)
    {
        $query = (new Query())
            ->select([
                'total_income' => 'SUM(IF(fi.item_type = "Доход", fi.amount, 0))',
                'total_expense' => 'SUM(IF(fi.item_type = "Расход", fi.amount, 0))',
            ])
            ->from(['fi' => 'financialitem'])
            ->andFilterWhere(['>=', 'fi.report_date', $startDate])
            ->andFilterWhere(['<=', 'fi.report_date', $endDate]);

        $financialData = $query->one();

        $totalIncome = $financialData['total_income'];
        $totalExpense = $financialData['total_expense'];

        $profitability = $totalExpense > 0 ? round(($totalIncome / $totalExpense) * 100, 2) : null;

        return $this->render('representational-profitability', [
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'profitability' => $profitability,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function actionTouristPurposeRatio($startDate = null, $endDate = null)
    {
        $query = (new Query())
            ->select([
                'trip_purpose',
                'total_tourists' => 'COUNT(*)',
                'percentage' => '(COUNT(*) / (SELECT COUNT(*) FROM tourist t'
                    . ($startDate && $endDate ? ' LEFT JOIN touristgroup tg ON t.group_id = tg.id WHERE tg.departure_date BETWEEN :start_date AND :end_date' : '')
                    . ')) * 100'
            ])
            ->from('tourist t')
            ->leftJoin('touristgroup tg', 't.group_id = tg.id')
            ->groupBy('trip_purpose');

        if ($startDate && $endDate) {
            $query->where(['between', 'tg.departure_date', $startDate, $endDate]);
            $query->addParams([':start_date' => $startDate, ':end_date' => $endDate]);
        }

        $data = $query->all();

        return $this->render('tourist-purpose-ratio', [
            'data' => $data,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function actionFlightTouristDetails($flight_id = null)
    {
        $flights = Flight::find()->select(['id', 'flight_number'])->asArray()->all();

        $query = (new Query())
            ->select([
                "CONCAT(t.surname, ' ', t.name, ' ', t.patronymic) AS full_name",
                'tg.group_name AS group_name',
                'h.hotel_name AS hotel_name',
                'SUM(c.number_of_pieces) AS total_cargo_pieces',
                'SUM(c.weight) AS total_cargo_weight',
                'SUM(c.volume_weight) AS total_cargo_volume_weight',
                'GROUP_CONCAT(DISTINCT c.markings SEPARATOR ", ") AS cargo_markings'
            ])
            ->from(['t' => 'tourist'])
            ->leftJoin(['tg' => 'touristgroup'], 't.group_id = tg.id')
            ->leftJoin(['a' => 'accommodation'], 'a.tourist_id = t.id')
            ->leftJoin(['h' => 'hotel'], 'a.hotel_id = h.id')
            ->leftJoin(['tf' => 'touristflight'], 't.id = tf.tourist_id')
            ->leftJoin(['f' => 'flight'], 'tf.flight_id = f.id')
            ->leftJoin(['fc' => 'flightcargo'], 'f.id = fc.flight_id')
            ->leftJoin(['c' => 'cargo'], 'fc.cargo_id = c.id')
            ->andFilterWhere(['f.id' => $flight_id])
            ->groupBy(['t.id', 'tg.group_name', 'h.hotel_name'])
            ->orderBy(['t.surname' => SORT_ASC]);

        $touristDetails = $query->all();

        return $this->render('flight-tourist-details', [
            'touristDetails' => $touristDetails,
            'flights' => $flights,
            'flight_id' => $flight_id,
        ]);
    }


}
