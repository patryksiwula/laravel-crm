<?php

namespace App\Services;

use App\Models\Client\Organization;
use App\Models\Client\Person;

class ClientService
{	
	/**
	 * Create a new organisation
	 *
	 * @param  array $attributes
	 * @return \App\Models\Client\Organization
	 */
	public function createOrganisation(array $attributes): Organization
	{
		$organisation = Organization::create($attributes);

		return $organisation;
	}
		
	/**
	 * Update an existing organisation
	 *
	 * @param  \App\Models\Client\Organization $organization
	 * @param  array $attributes
	 * @return \App\Models\Client\Organization
	 */
	public function updateOrganization(Organization $organization, array $attributes): Organization
	{
		$organization->update($attributes);

		return $organization;
	}
	
	/**
	 * Create a new person
	 *
	 * @param  array $attributes
	 * @return \App\Models\Client\Person
	 */
	public function createPerson(array $attributes): Person
	{
		$person = Person::create($attributes);

		return $person;
	}
	
	/**
	 * Update an existing person
	 *
	 * @param  \App\Models\Client\Person $person
	 * @param  array $attributes
	 * @return \App\Models\Client\Person
	 */
	public function updatePerson(Person $person, array $attributes): Person
	{
		$person->update($attributes);

		return $person;
	}
}