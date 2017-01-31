<?php

class Wine {

  private $conn;
  private $table_name = "wine";

  public $id;
  public $name;
  public $year;
  public $grapes;
  public $picture;
  public $country;
  public $region;
  public $description;

  public function __construct($db){
    $this->conn = $db;
  }

  function create() {
    $query = "INSERT INTO " . $this->table_name . 'SET name=:name,
    year=:year, grapes=:grapes, picture=:picture, country=:country,
    region=:region, description=:description';

    $stmt = $this->conn->prepare($query);

    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->year=htmlspecialchars(strip_tags($this->year));
    $this->grapes=htmlspecialchars(strip_tags($this->grapes));
    $this->picture=htmlspecialchars(strip_tags($this->picture));
    $this->country=htmlspecialchars(strip_tags($this->country));
    $this->region=htmlspecialchars(strip_tags($this->region));
    $this->description=htmlspecialchars(strip_tags($this->description));

    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":year", $this->year);
    $stmt->bindParam(":grapes", $this->grapes);
    $stmt->bindParam(":picture", $this->picture);
    $stmt->bindParam(":country", $this->country);
    $stmt->bindParam(":region", $this->region);
    $stmt->bindParam(":description", $this->description);

    if($stmt->execute()) {
      return true;
    }else {
      echo '<pre>';
        print_r($stmt->errorInfo());
      echo '</pre>';
      return false;
    }
  }

  function readAll() {
    $query = 'SELECT id, name, year, grapes, picture, country, region, description FROM ' . $this->table_name;

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  function readOne() {
    $query = 'SELECT name, year, grapes, picture, country, region, description FROM ' .$this->table_name . ' WHERE id = ? LIMIT 0,1';

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->name = $row['name'];
    $this->year = $row['year'];
    $this->grapes = $row['grapes'];
    $this->picture = $row['picture'];
    $this->country = $row['country'];
    $this->region = $row['region'];
    $this->description = $row['description'];
  }

  function update() {
    $query = 'UPDATE ' . $this->table_name . ' SET name=:name, year=:year, grapes=:grapes, picture=:picture, country=:country, region=:region, description=:description WHERE id=:id';

    $stmt = $this->conn->prepare($query);

    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->year=htmlspecialchars(strip_tags($this->year));
    $this->grapes=htmlspecialchars(strip_tags($this->grapes));
    $this->picture=htmlspecialchars(strip_tags($this->picture));
    $this->country=htmlspecialchars(strip_tags($this->country));
    $this->region=htmlspecialchars(strip_tags($this->region));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":year", $this->year);
    $stmt->bindParam(":grapes", $this->grapes);
    $stmt->bindParam(":picture", $this->picture);
    $stmt->bindParam(":country", $this->country);
    $stmt->bindParam(":region", $this->region);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":id", $this->id);

    if($stmt->execute()) {
      return true;
    }else {
      return false;
    }
  }

  function delete() {
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE id = ?';

    $stmt = $this->conn->prepare($query);

    $this->id=htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(1, $this->id);

    if($stmt->execute()) {
      return true;
    }else {
      return false;
    }
  }
}
