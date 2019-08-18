<?php


use Phinx\Seed\AbstractSeed;

class ClientSeeder extends AbstractSeed
{
    const CAR_COLOR = [
        'cinza',
        'preto',
        'amarelo',
        'azul',
        'verde',
        'prata',
        'vermelho',
        'branco'
    ];

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

        foreach( range(1,10) as $value )
        {
            $dataCPF[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->email(),
                'phone_prefix' => $faker->randomNumber(2),
                'phone' => $faker->phone(),
                'doc_id' => $faker->cpf,
                'doc_type' => 'cpf',
                'car_model' => $this->getCarModel(),
                'car_color' => $this->getCarColor(),
                'created_at' => $this->getCreatedAt($faker),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        foreach( range(1,10) as $value )
        {
            $dataCNPJ[] = [
                'email' => $faker->unique()->email(),
                'company_category' => $this->getCompanyCategory(),
                'doc_id' => $faker->cnpj,
                'doc_type' => 'cnpj',
                'created_at' => $this->getCreatedAt($faker),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $client->insert( $dataCPF )->save();
        $client->insert( $dataCNPJ )->save();
    }

    public function getCreatedAt($faker)
    {
        return date_format( $faker->dateTimeThisYear(), 'Y-m-d H:i:s');
    }

    public function getCompanyCategory()
    {
        return \Faker\Provider\Base::randomElement(self::COMPANY_CATEGORY);
    }

    public function getCarModel()
    {
        return \Faker\Provider\Base::randomElement(self::CAR_MODEL);
    }

    public function getCarColor()
    {
        return \Faker\Provider\Base::randomElement(self::CAR_COLOR);
    }
}
