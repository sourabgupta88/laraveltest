<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
   
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'customer_id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'middle_name',
        'dob',
        'gender',
        'marital_status',
        'mobile_phone',
        'address',
        'current_street_number',
        'current_street_name',
        'current_street_type',
        'current_suburb',
        'current_state',
        'current_postcode',
        'current_unit_number',
	];

    public static $createRules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email:rfc,dns',
    ];

    public static $updateRules = [
        'customer_id' => 'required|numeric',
    ];

    public static $maritalStatus = [
			'single',
			'married',
			'de_facto',
			'divorced',
			'widowed',
			'separated'
		];

    public static $streetTypes = [
				'ALLEY', 'ALLY', 'APPROACH', 'APP', 'ARCADE', 'ARC', 'AVENUE', 'AVE', 'BOULEVARD', 'BVD', 'BLVD', 'BROW', 'BYPASS', 'BYPA',
				'CAUSEWAY', 'CWAY', 'CIRCUIT', 'CCT', 'CIRCUS', 'CIRC', 'CLOSE', 'CL', 'COPSE', 'CPSE', 'CORNER', 'CNR', 'COVE', 'COURT',
				'CT', 'CRESCENT', 'CRES', 'DRIVE', 'DR', 'ELBOW', 'ELB', 'END', 'ESPLANADE', 'ESP', 'FLAT', 'FREEWAY', 'FWAY', 'FRONTAGE',
				'FRNT', 'GARDENS', 'GDNS', 'GLADE', 'GLD', 'GLEN', 'GREEN', 'GRN', 'GROVE', 'GR', 'HEIGHTS', 'HTS', 'HIGHWAY', 'HWY', 'LANE',
				'LN', 'LINK', 'LOOP', 'MALL', 'MEWS', 'PACKET', 'PCKT', 'PARADE', 'PDE', 'PARK', 'PARKWAY', 'PKWY', 'PLACE', 'PL', 'PROMENADE',
				'PROM', 'RESERVE', 'RES', 'RIDGE', 'RDGE', 'RISE', 'ROAD', 'RD', 'ROW', 'SQUARE', 'SQ', 'STREET', 'ST', 'STRIP', 'STRP', 'TARN',
				'TERRACE', 'TCE', 'THOROUGHFARE', 'TFRE', 'TRACK', 'TRAC', 'TRUNKWAY', 'TWAY', 'VIEW', 'VISTA', 'VSTA', 'WALK', 'WAY', 'WALKWAY',
				'WWAY', 'YARD'
		];

	public static $states = ['ACT','NSW','NT','QLD','SA','TAS','VIC','WA'];

    public static $genderTypes = [
      'm',
      'f'
    ];

    public function getFillable(){
      return $this->fillable;
    }
}
