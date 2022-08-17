<?php

namespace App\Services;

use App\Models\Client\Organization;
use App\Models\Client\Person;

class ClientService
{	
	/**
	 * Create a new organisation
	 *
	 * @param  string $name
	 * @param  string $email
	 * @param  string $phone
	 * @param  string $address
	 * @param  string $vat
	 * @return \App\Models\Client\Organization
	 */
	public function createOrganisation(string $name, string $email, string $phone, string $address, string $vat): Organization
	{
		$organisation = Organization::create([
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'address' => $address,
			'vat' => $vat
		]);

		return $organisation;
	}
		
	/**
	 * Update an existing organisation
	 *
	 * @param  \App\Models\Client\Organization $organization
	 * @param  string $name
	 * @param  string $email
	 * @param  string $phone
	 * @param  string $address
	 * @param  string $vat
	 * @return \App\Models\Client\Organization
	 */
	public function updateOrganization(Organization $organization, string $name, string $email, string $phone, string $address, string $vat): Organization
	{
		$fieldsToUpdate = [];

		if ($name != $organization->name)
			$fieldsToUpdate['name'] = $name;

		if ($email != $organization->email)
			$fieldsToUpdate['email'] = $email;

		if ($phone != $organization->phone)
			$fieldsToUpdate['phone'] = $phone;
		 
		if ($address != $organization->address)
			$fieldsToUpdate['address'] = $address;
		
		if ($vat != $organization->vat)
			$fieldsToUpdate['vat'] = $vat;

		$organization->update($fieldsToUpdate);

		return $organization;
	}
	
	/**
	 * Create a new person
	 *
	 * @param  string $name
	 * @param  string $email
	 * @param  string $phone
	 * @param  string $address
	 * @return \App\Models\Client\Person
	 */
	public function createPerson(string $name, string $email, string $phone, string $address): Person
	{
		$person = Person::create([
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'address' => $address
		]);

		return $person;
	}
	
	/**
	 * Update an existing person
	 *
	 * @param  \App\Models\Client\Person $person
	 * @param  string $name
	 * @param  string $email
	 * @param  string $phone
	 * @param  string $address
	 * @return \App\Models\Client\Person
	 */
	public function updatePerson(Person $person, string $name, string $email, string $phone, string $address): Person
	{
		$fieldsToUpdate = [];

		if ($name != $person->name)
			$fieldsToUpdate['name'] = $name;

		if ($email != $person->email)
			$fieldsToUpdate['email'] = $email;

		if ($phone != $person->phone)
			$fieldsToUpdate['phone'] = $phone;
		 
		if ($address != $person->address)
			$fieldsToUpdate['address'] = $address;

		$person->update($fieldsToUpdate);

		return $person;
	}
}