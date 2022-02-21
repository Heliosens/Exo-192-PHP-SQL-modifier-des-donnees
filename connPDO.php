<?php


class connPDO
{
    private string $server;
    private string $user;
    private string $password;
    private string $dbName;

    public function __construct(){
        $this->setServer('localhost');
        $this->setUser('root');
        $this->setPassword('');
        $this->setDbName('exo192');
    }

    /**
     * @param mixed $server
     * @return connPDO
     */
    public function setServer($server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * @param mixed $user
     * @return connPDO
     */
    public function setUser($user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param mixed $password
     * @return connPDO
     */
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param mixed $dbName
     * @return connPDO
     */
    public function setDbName($dbName): self
    {
        $this->dbName = $dbName;
        return $this;
    }

    /**
     * db connection
     */
    public function conn () : ?PDO {
        try {
            $conn = new PDO("mysql:host=".$this->server.";dbname=".$this->dbName.";charset=utf8", $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            return $conn;
        }
        catch (PDOException $e){
            echo "Error : " . $e->getMessage();
        }
        return null;
    }
}
