<?php

namespace Edu\Cnm\Kmaru\Test;

use Edu\Cnm\Kmaru\Profile;
use Edu\Cnm\Kmaru\Board;
use Edu\Cnm\Kmaru\Card;
use Edu\Cnm\Kmaru\Ledger;

// grab autoloader to load classes for testing
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid/php");

/**
 * Full PHPUnit test for the Profile class
 *
 * This is a complete PHPUnit test of the Ledger class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Ledger
 * @author Kenneth Keyes tbennett19@cnm.edu
 **/

class LedgerTest extends KmaruTest {

	/**
	 *  board of the game being played. This is a foreign key relationship
	 * @var Board $board
	 **/
	protected $board;

	/**
	 *  card that is being answered. This is a foreign key relationship
	 * @var Card $card
	 **/
	protected $card;

	/**
	 *  profile that is answering the question. This is a foreign key relationship
	 * @var Profile $profile
	 **/
	protected $profile;

	/**
	 * valid points to use
	 * @var int $VALID_POINTS
	 **/
	protected $VALID_POINTS;

	/**
	 * valid type to use
	 * @var int $VALID_TYPE
	 **/
	protected $VALID_TYPE;


	/**
 	* create dependant objects before running each test
 	**/
	public final function setUp() : void {

		//run default setUp method first from parent KmaruTest
		parent::setUp();

		// create a salt and hash for the mocked profile
		$password = "poodledoodle2";
		$this->VALID_SALT = bin2hex(random_bytes(32));
		$this->VALID_HASH = hash_pbkdf2("sha512", $password, $this->VALID_SALT, 262144);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));

		//create and insert a Profile to answer the cards on the ledger
		$this->profile = new Profile(generateUuidV4(), null, "tbennett19@cnm.edu", $this->VALID_HASH, "Captain Jean-Luc Picard", "123",$this->VALID_SALT, "FinallyWeek5");
		$this->profile->insert($this->getPDO());

		//TODO: can you use genUuid for player ID or do you pull with $this?
		// create and insert a Board to contain the cards contained in the ledger
		$this->profile = new Board(generateUuidV4(), generateUuidV4(), "Treking");
		$this->profile->insert($this->getPDO());

		// create and insert a Card to be answered by the profile on the board for the ledger
		$this->profile = new Card(generateUuidV4(), generateUuidV4(), "Read the Documentation!", 200, "If you are unsure of what you are writing...what should you do next?");
		$this->profile->insert($this->getPDO());
	}












}