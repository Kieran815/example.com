<!-- Classes
The classic example of a class and class properties is to think of a person. A Person class would have properties such as a head, arms, legs, etc. I prefer to think in terms of completing work as this is really what we want our classes to do. For example, if I were to have a class for reading and writing to and from the database I might call it DBWorker. Now the question is what do I need DBWorker to do?

I'll need my DBWorker class to

connect to the database
know which table to access
write new records to the database
read records in from the database
update records in the database
delete records from the database
So far my properties would be as follows

Instance Variable - table
Method - connect()
Method - create()
Method - read()
Method - update()
Method - delete()
In PHP this might look like the following:

class DBWorker
{
    private $table = null;

    public function __construct($connection, $table) {
      $this->connect($connection);
      $this->$table = $table;
    }

    private function connect($connection){//do something}

    public function create($data) {//do something}

    public function read($whereClause) {//do something}

    public function update($data, $whereClause) {//do something}

    public function delete($whereClause) {//do something}

}
 -->

 <?php

/**
 * A mock up of session data
 */
class Session
{
  /**
   * Returns the current user session
   * @return array Session Data
   */
  public function read()
  {
    return ['id'=>'1234', 'name'=>'Kieran'];
  }
}

/**
 * Returns a greeting to a given user
 */
class Hello
{
  /**
   * An instance variable to hold the name of the user
   * @var string
   */
  private $who;

  /**
   * A constructor method - Constructor injection with type hinting. Constructor injection is a form of type hinting.
   * @param  Object $session A user session
   */
  public function __construct(Session $session) {

    $sessionData = $session->read();

    $this->setWho($sessionData['name']);
  }

  /**
   * A setter method for Hello::who
   * @param String $who - The name of a given user
   */
  public function setWho($who)
  {
    $this->who = $who;
  }

  /**
   * Returns a greeting to a target user
   * @param  {[type]} $message [description]
   * @return {[type]}          [description]
   */
  public function greet($message)
  {
    return "{$message} {$this->who}";
  }

}

//Instantiate the Session class
$session = new Session();

//Instantiate the Hello class. Inject the $session object into the constructor.
$greeting = new Hello($session);

//Provide a message for the user (Ternary Logic)
$message = 'Good ' . (date("H")<12?'Morning,':(date("H")<17?'Afternoon,':'Evening,'));

echo $greeting->greet($message);