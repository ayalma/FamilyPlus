<?php
namespace Models;
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/16/2016
 * Time: 1:08 PM
 */
class Group implements \JsonSerializable
{
    private $_id;    //Group ID
    private $_admin; //group admin
    private $_name; //group name.
    private $_members; // member of groups

    /**
     * Group constructor.
     * @param int $_id
     * @param User $_admin
     * @param String $_name
     * @param User[] $members
     */
    public function __construct($_id = 0, User $_admin = null, $_name = '', $members = null)
    {
        $this->_id = $_id;
        $this->_admin = $_admin;
        $this->_name = $_name;
        $this->_members = $members;
    }

    public static function fromJSON($json)
    {
        $obj = new Group();
        $jsonValue = json_decode($json);
        
        $mapper = new \JsonMapper();
        $mapper->map($jsonValue, $obj);
      
        return $obj;

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return User
     */
    public function getAdmin()
    {
        return $this->_admin;
    }

    /**
     * @param User $admin
     */
    public function setAdmin($admin)
    {
        $this->_admin = $admin;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return User[]
     */
    public function getMembers()
    {
        return $this->_members;
    }

    /**
     * @param User[] $members
     */
    public function setMembers($members)
    {
        $this->_members = $members;
    }
    
    


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        $json = array();

        foreach ($this as $key => $value) {
            $key = str_replace('_', '', $key);
            $json[$key] = $value;
        }

        return $json; // or json_encode($json)
    }
}