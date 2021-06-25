<?php

class Database {

    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbpass;
    private $dbcharset;

    private $pdo;


    /**
     * Connects to the database
     */
    public function __construct(string $host = 'localhost', string $username = 'root', string $password = '', string $dbname = 'examenvoorbereiding', string $charset = 'utf8')
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->charset = $charset;
        $this->username = $username;
        $this->password = $password;

        try
        {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
        }
        catch(\PDOException $exception)
        {
            exit('Unable to connect. Error message: ' . $exception->getMessage());
        }
    }
    

    public function create_new_user(int $type_id, string $username, string $email, string $password): void
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users VALUES 
            (NULL, :type_id, :username, :email, :password, :created_at, NULL)';

        $this->statement_execute($sql, [
            'type_id' => $type_id,
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function create_admin()
    {
        $hashed_password = password_hash('admin', PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users VALUES
            (NULL, :type_id, :username, :email, :password, :created_at, NULL)';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'type_id' => 1,
            'username' => 'admin',
            'email' => 'admin@example.org',
            'password' => $hashed_password,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function login(string $username, string $password): void
    {
        $sql = 'SELECT type_id, password FROM users WHERE username = :username';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'username' => $username
        ]);

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if (!empty($results) && password_verify($password, $results['password']))
        {
            session_start();
            $_SESSION['logged_in_as'] = $username;
            $_SESSION['is_admin'] = $results['type_id'] === '1';

            header('Location: views/users/index.php');
        }
        else
            header('Location: login_incorrect.html');
    }


    public function users_overview(): array
    {

        $sql = 'SELECT user_types.name as type, users.id, users.username, users.email, users.created_at, users.updated_at
    FROM users
    LEFT JOIN user_types
        ON users.type_id = user_types.id';


        $statement = $this->statement_execute($sql);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function delete_user(int $id): void
    {
        $sql = 'DELETE FROM users WHERE id = :id';

        $this->statement_execute($sql, [
            'id' => $id
        ]);
    }

    public function get_user_types(): array
    {
        $sql = 'SELECT id, name as type FROM user_types order by id asc';

        $statement = $this->statement_execute($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_user(int $id): array
    {
        $sql = 'SELECT type_id, username, email FROM users WHERE id = :id';

        $statement = $this->statement_execute($sql, [
            'id' => $id
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function update_user(int $id, int $type_id, string $username, string $email, string $password): void
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'UPDATE users SET type_id = :type_id, username = :username, email = :email, password = :password WHERE id = :id';

        $this->statement_execute($sql, [
            'type_id' => $type_id,
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'id' => $id,
        ]);
    }

    public function create_default_hours(): void
    {
        $sql  ='INSERT INTO hours (user_id, starts_at, ends_at)
        VALUES
            (:user_id, :start1, :end1),
            (:user_id, :start2, :end2)';

        $this->statement_execute($sql, [
            'user_id' => 2,

            'start1' => '2021-06-03 10:30',
            'end1' => '2021-06-03 12:30',
            'start2' => '2021-06-07 11:00',
            'end2' => '2021-06-11 11:00'
        ]);
    }

    public function hours_overview(): array
    {
        $sql = 'SELECT users.username as user, department_id as department, hours.id, hours.starts_at, hours.ends_at
        FROM hours
        LEFT JOIN users
            ON hours.user_id = users.id';

        $statement = $this->statement_execute($sql);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $index => $value)
        {
            $results[$index]['starts_at_unix'] = strtotime($value['starts_at']);
            $results[$index]['ends_at_unix'] = strtotime($value['ends_at']);
        }

        return $results;
    }

    public function insert_hour(int $user_id, int $department_id, string $starts_at, string $ends_at): void
    {
        $sql = 'INSERT INTO hours (user_id, department_id, starts_at, ends_at) VALUES (:user_id, :department_id, :starts_at, :ends_at)';

        $this->statement_execute($sql, [
            'user_id' => $user_id,
            'department_id' => $department_id,
            'starts_at' => $starts_at,
            'ends_at' => $ends_at,
        ]);
    }

    public function delete_hour(int $id): void
    {
        $sql = 'DELETE FROM hours WHERE id = :id';

        $this->statement_execute($sql, [
            'id' => $id
        ]);
    }

    public function assign_default_users_to_departments(): void
    {
        $sql = 'INSERT INTO department_user
        VALUES
            (:department1, :user1),
            (:department2, :user1),
            (:department1, :user2),
            (:department2, :user2)';

        // $this->statement_execute vind je in les 7
        $this->statement_execute($sql, [
            'department1' => 1,
            'department2' => 2,
            'user1' => 1,
            'user2' => 2
        ]);
    }

    public function department_user_overview(): array
    {
        $sql = 'SELECT departments.id as id, departments.name as department_name, users.id as user_id, users.username as username
        FROM department_user
        LEFT JOIN departments
            ON department_user.department_id = departments.id
        LEFT JOIN users
            ON department_user.user_id = users.id';

        $statement = $this->statement_execute($sql);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function deparments_overview(): array
    {

        $sql = 'SELECT departments.id, departments.name, departments.city, departments.post_code FROM departments';

        $statement = $this->statement_execute($sql);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    private function statement_execute($sql, $params = []): PDOStatement
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        return $statement;
    }

    // /* ====== Setup ====== */
    
    // public function create_default_users(): void
    // {
    //     $admin_hashed_password = password_hash('admin', PASSWORD_BCRYPT);
    //     $user1_hashed_password = password_hash('user1', PASSWORD_BCRYPT);
    //     $user2_hashed_password = password_hash('user2', PASSWORD_BCRYPT);

    //     $sql = 'insert into users (type_id, username, email, password)
    //     values
    //         (:admin_type_id, :admin_user, :admin_email, :admin_pass),
    //         (:user_type_id, :user1_user, :user1_email, :user1_pass),
    //         (:user_type_id, :user2_user, :user2_email, :user2_pass)';

    //     $this->statement_execute($sql, [
    //         'admin_type_id' => 1,
    //         'admin_user' => 'admin',
    //         'admin_email' => 'admin@example.org',
    //         'admin_pass' => $admin_hashed_password,

    //         'user_type_id' => 2,

    //         'user1_user' => 'user1',
    //         'user1_email' => 'user1@example.org',
    //         'user1_pass' => $user1_hashed_password,

    //         'user2_user' => 'user2',
    //         'user2_email' => 'user2@example.org',
    //         'user2_pass' => $user2_hashed_password
    //     ]);
    // }

    // public function create_default_hours(): void
    // {
    //     $sql = 'insert into hours (user_id, department_id, starts_at, ends_at)
    //     values
    //         (:user_id1, :department_id1, :starts_at1, :ends_at1),
    //         (:user_id2, :department_id2, :starts_at2, :ends_at2);';

    //     $this->statement_execute($sql, [
    //         'user_id1' => 2,
    //         'department_id1' => 1,
    //         'starts_at1' => '2021-06-03 10:30:00',
    //         'ends_at1' => '2021-06-03 12:30:00',

    //         'user_id2' => 3,
    //         'department_id2' => 2,
    //         'starts_at2' => '2021-06-07 08:00:00',
    //         'ends_at2' => '2021-06-11 16:00:00'
    //     ]);
    // }

    // public function assign_default_users_to_departments(): void
    // {
    //     $sql = 'insert into department_user
    //     values
    //         (:department1, :user1),
    //         (:department1, :user2),
    //         (:department2, :user1),
    //         (:department2, :user2);';

    //     $this->statement_execute($sql, [
    //         'department1' => 1,
    //         'user1' => 2,

    //         'department2' => 2,
    //         'user2' => 3
    //     ]);
    // }

    // /* ====== Users ====== */


    public function get_department(int $id): array
    {
        $sql = 'SELECT id, name FROM departments WHERE id = :id';

        $statement = $this->statement_execute($sql, [
            'id' => $id
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_users_by_department(int $department_id): array
    {

        $sql = 'SELECT users.id, users.username, users.email
        FROM `department_user`
        INNER JOIN `users`
            ON users.id = department_user.user_id
        WHERE department_user.department_id = :department_id
        ORDER by users.created_at';

        $statement = $this->statement_execute($sql, [
            'department_id' => $department_id
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add_user_to_department(string $department_id, string $user_id): void
    {

        $sql = 'INSERT INTO `department_user`
        VALUES (:department_id, :user_id)';

        $this->statement_execute($sql, [
            'department_id' => $department_id,
            'user_id' => $user_id
        ]);
    }

    public function remove_user_from_department(string $department_id, string $user_id): void
    {

        $sql = 'DELETE FROM `department_user`
        WHERE `department_id` = :department_id
            AND user_id = :user_id';

        $this->statement_execute($sql, [
            'department_id' => $department_id,
            'user_id' => $user_id
        ]);
    }

    /* ====== Users ====== */
    public function create_user(int $type_id, string $username, string $email, string $password = null): void
    {
        // Als het wachtwoord toch niet sterk genoeg is exitten we. Dan gaat de functie ook niet meer door.
        if ($this->check_password_strong_enough($password) === false)
            exit('Het wachtwoord was niet sterk genoeg. <a href="/views/users/create.php">Ga terug</a> en probeer het nog een keer.');
        else
        {
            // Als we hier komen, is het wachtwoord dus sterk genoeg!
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO users (type_id, username, email, password)
            VALUES (:type_id, :username, :email, :password)';

            $this->statement_execute($sql, [
                'type_id' => $type_id,
                'username' => $username,
                'email' => $email,
                'password' => $hashed_password
            ]);
        }
    }

    /* ====== Hours ====== */
    public function create_hour(int $user_id, int $department_id, string $starts_at, string $ends_at): void
    {
        if ($this->check_department_user($department_id, $user_id) === false)
            exit('Deze gebruiker is niet toegewezen aan deze afdeling. <a href="/views/hours">Ga terug</a> en probeer het nog een keer.');
        elseif ($this->check_hour_starts_before_end($starts_at, $ends_at) === false)
            exit('Het startmoment moet zich <i>voor</i> het eindemoment plaatsvinden. <a href="/views/hours">Ga terug</a> en probeer het nog een keer.');
        else
        {
            $sql = 'INSERT INTO hours (user_id, department_id, starts_at, ends_at)
            VALUES (:user_id, :department_id, :starts_at, :ends_at)';

            $this->statement_execute($sql, [
                'user_id' => $user_id,
                'department_id' => $department_id,
                'starts_at' => $starts_at,
                'ends_at' => $ends_at
            ]);
        }
    }

    /* ====== Helper functions ====== */

    // Dit staat in een functie voor hergebruikbaarheid
    // Als je nu iets veranderd aan je password-policy hoef je het maar op één plek te veranderen
    private function check_password_strong_enough(string $password): bool
    {
        return strlen($password) >= 8;
    }

    private function check_department_user(int $department_id, int $user_id): bool
    {
        // AS ... betekent dat de key er op die manier uitkomt
        // Dus in dit geval gebruik je straks ['count'] in PHP (in plaats van ['COUNT(*)'])
        $sql = 'SELECT COUNT(*) AS count
        FROM department_user
        WHERE department_id = :department_id
            AND user_id = :user_id';

        $statement = $this->statement_execute($sql, [
            'department_id' => $department_id,
            'user_id' => $user_id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Als de count meer dan 0 is (1 of meer, dus) komt de combinatie voor; dan moet hij true zijn!
        return $result['count'] > 0;
    }

    private function check_hour_starts_before_end(int $start_at, int $end_at): bool
    {
        // In PHP kun je gewoon datumnotaties zoals "2021-06-18 13:30:00" met elkaar vergelijken!
        // PHP zet het on-the-fly in een DateTimeImmutable, dus het kost wel wat extra werk
        // Dit doet dus date('Y-m-d H:i:s', $start_at) < date(......
        return $start_at < $end_at;
    }
}
