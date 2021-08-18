<?php

namespace App\Modules\Clients\DTO;

use App\Modules\Clients\Exceptions\UnsupportedFilterException;

class FilterData
{

    private $name;
    private $Lastname;
    private $email;
    private $phone;

    /**
     * @throws \Exception
     */
    public function __construct(string $fields = null, $values = null)
    {
        $filterFields = explode(',', $fields);
        $filterValues = explode(',', $values);
        $filterData   = array_combine($filterFields, $filterValues);
        foreach ($filterData as $field => $value) {
            if (property_exists($this, $field)) {
                $this->$field = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->Lastname;
    }


}
