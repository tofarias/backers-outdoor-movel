<?php


use Phinx\Seed\AbstractSeed;

class ClientSeeder extends AbstractSeed
{
    const CAR_MODEL = [
        'Classe SLS AMG',
        'Classe X',
        'Doblò',
        'Doblò Cargo',
        'DS3',
        'Compass',
        'Continental Flying Spur',
        'Golf',
        'Golf Variant',
        'Gran Cabrio',
        'Continental Supersports Coupé',
        'Cooper',
        'Fit',
        'Focus'
    ];

    const COMPANY_CATEGORY = [
        'Fábrica de roupas',
        'Fábrica de computadores',
        'Restaurante',
        'Supermercado',
        'Atacado de laticínios',
        'Armarinho',
        'Fábrica de esquadrias',
        'Loja de ferragem',
        'Fábrica de móveis artesanais',
        'Lavanderia',
        'Cinema',
        'Hospital',
        'Escola'
    ];

    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $faker->addProvider($this);
        $client = $this->table('client');

        $dataCPF = $dataCNPJ = [];

        foreach( range(1,5) as $value )
        {
            $dataCPF[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->email(),
                'phone' => $faker->phone(),
                'doc_id' => 'cpf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        foreach( range(1,5) as $value )
        {
            $dataCNPJ[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->email(),
                'phone' => $faker->phone(),
                'company_category' => $this->getCompanyCategory(),
                'car_model' => $this->getCarModel(),
                'doc_id' => 'cnpj',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $client->insert( $dataCPF )->save();
        $client->insert( $dataCNPJ )->save();
    }

    public function getCompanyCategory()
    {
        return \Faker\Provider\Base::randomElement(self::COMPANY_CATEGORY);
    }

    public function getCarModel()
    {
        return \Faker\Provider\Base::randomElement(self::CAR_MODEL);
    }
}
