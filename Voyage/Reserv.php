<?php


class reserv {

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

        /**
     * Récupère les évènements commençant entre 2 dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getReservBetween (\DateTime $start, \DateTime $end): array {

       

        $sql = "SELECT * FROM reserv WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }


 /**
     * Récupère les évènements commençant entre 2 dates indexé par jour
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getReservBetweenByDay (\DateTime $start, \DateTime $end): array {
        $reserv = $this->getReservBetween($start, $end);
        $days = [];
        foreach($reserv as $reserva) {
            $date = explode(' ', $reserva['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$reserva];
            } else {
                $days[$date][] = $reserva;
            }
        }
        return $days;
    }
   /**
     * Récupère un évènement
     * @param int $id
     * @return Event
     * @throws \Exception
     */
    public function find (int $id): reservat {
        require 'reserva2.php';
        $statement = $this->pdo->query("SELECT * FROM reserv WHERE id = $id LIMIT 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, reservat::class);
        $result = $statement->fetch();
        if ($result === false) {
            throw new \Exception('Aucun résultat n\'a été trouvé');
        }
        return $result;
    }

    public function getdisponibilite($date)
    {
        $id = $_GET['id'];
        $sql = "SELECT `id_Reservation`,`Date_Arrivee`,`Date_Depart` FROM RESERVATION WHERE `id_Reservation` = $id AND (`Date_Arrivee` = $date OR `Date_Depart` = $date ";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }

}