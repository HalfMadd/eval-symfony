<?php

namespace App\Form\Model;


class ContactFormModel
{

	private $firstname = null;
	private $lastname = null;
	private $email = null;
	private $message = null;

	public function setFirstName(?string $firstname):void { $this->firstname = $firstname; }
	public function setLastName(?string $lastname):void { $this->lastname = $lastname; }
	public function setEmail(?string $email):void { $this->email = $email; }
	public function setMessage(?string $message):void { $this->message = $message; }

	public function getFirstname():?string { return $this->firstname; }
	public function getLastname():?string { return $this->lastname; }
	public function getEmail():?string { return $this->email; }
	public function getMessage():?string { return $this->message; }
}









