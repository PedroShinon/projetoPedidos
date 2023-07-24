<<<<<<< HEAD
<<<<<<< HEAD
# projetoPedidos
projeto pedidos,  
=======
=======
>>>>>>> 16fd2eb3d47665236a9daea1fe08d625299020ae
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
<<<<<<< HEAD
>>>>>>> 16fd2eb (first commit)
=======
>>>>>>> 16fd2eb3d47665236a9daea1fe08d625299020ae



	DOCUMENTAÇÃO API ( PROJETO PEDIDOS )

Padrão de rotas de register, login, logout, CRUD (USERS):

Ato REGISTRAR USUÁRIO:
	VERBOSE: POST
	URL: http://127.0.0.1:8000/api/v1/register
	DADOS ENVIADOS ACEITOS (exemplo):
	{
        "nome": "Jhon",
        "nome_loja": "GarnetPrograming",
        "cnpj_cpf": "70780494313",
        "telefone": "98983344844",
        "email": "pedro@email.com",
        "logradouro": "Rua 14",
        "numero": "03",
        "bairro": "Cohatrac IV",
        "cidade": "São Luís",
        "uf": "MA"
    }

    REGRAS DE ACEITAÇÂO:
	    'nome' => ['required', 'max:100 caracteres' ],
        'nome_loja' => ['required', 'max:100 caracteres'],
        'email' => ['required', 'email', 'max:100 caracteres' ],
        'cnpj_cpf' => ['required', 'deve ser único no banco', 'min:11 caracteres', 'max:14 	caracteres'],
        'telefone' => ['required', 'min:9 caracteres' , 'max:21 caracteres' ],
        'logradouro' => ['required', 'max:200 caracteres'],
        'numero' => ['required', 'max:20 caracteres'],
        'bairro' => ['required', 'max:100 caracteres'],
        'cidade' => ['required', 'max:100 caracteres'],
        'uf' => ['required', 'max:2 caracteres']	

required = Obrigatório.

EM CASO DE ACERTO DAS REGRAS E DADOS ENVIADOS E REGISTRO VÁLIDO, RETORNA OS DADOS:

{
    "message": "Usuario criado",
    "status": 200,
    "data": {
        "user": {
            "nome": "Jhon",
            "nome_loja": "GarnetPrograming",
            "cnpj_cpf": "70780494313",
            "telefone": "98983344844",
            "email": "pedro@email.com",
            "tipo_usuario": "user",
            "logradouro": "Rua 02",
            "numero": "15",
            "bairro": "Cohatrac IV",
            "cidade": "São Luís",
            "uf": "MA",
            "permissao": true,
            "updated_at": "2023-07-06T19:21:55.000000Z",
            "created_at": "2023-07-06T19:21:55.000000Z",
            "id": 1
        },
        "token": {
            "accessToken": {
                "name": "userAccess",
                "abilities": [
                    "user_privilege"
                ],
                "expires_at": null,
                "tokenable_id": 1,
                "tokenable_type": "App\\Models\\User",
                "updated_at": "2023-07-06T19:21:55.000000Z",
                "created_at": "2023-07-06T19:21:55.000000Z",
                "id": 1
            },
            "plainTextToken": "1|avA74WVsm4ptRMm2yVaMRlcq86pXjE4mp3TlwWWO"
        }
    },
    "errors": []
}

EM CASO DE ERRO OU NULO ENVIO:
	{
    "message": "O campo nome é obrigatório. (and 9 more errors)",
    "errors": {
        "nome": [
            "O campo nome é obrigatório."
        ],
        "nome_loja": [
            "O campo nome loja é obrigatório."
        ],
        "email": [
            "O campo email é obrigatório."
        ],
        "cnpj_cpf": [
            "O campo cnpj cpf é obrigatório."
        ],
        "telefone": [
            "O campo telefone é obrigatório."
        ],
        "logradouro": [
            "O campo logradouro é obrigatório."
        ],
        "numero": [
            "O campo numero é obrigatório."
        ],
        "bairro": [
            "O campo bairro é obrigatório."
        ],
        "cidade": [
            "O campo cidade é obrigatório."
        ],
        "uf": [
            "O campo uf é obrigatório."
        ]
    }
}


Ato LOGAR USUÁRIO:
	VERBOSE: POST
	URL: http://127.0.0.1:8000/api/v1/login
	DADOS ENVIADOS ACEITOS (exemplo json format):

    {
       "cnpj_cpf": "90280494313" 
    }
		


	REGRAS DE ACEITAÇÂO:
            	'cnpj_cpf' => ['obrigatório', 'deve existir no database', 'min:11 caracteres', 'max:14 	caracteres'],
	
	EM CASO DE ACERTO DAS REGRAS E DADOS ENVIADOS E REGISTRO VÁLIDO, RETORNA OS DADOS:
{
    "message": "Usuario logado",
    "status": 200,
    "data": {
        "user": {
            "id": 1,
            "nome": "Jhon",
            "nome_loja": "GarnetPrograming",
            "cnpj_cpf": "70780494313",
            "telefone": "98983344844",
            "email": "pedro@email.com",
            "logradouro": "Rua 14",
            "numero": "03",
            "bairro": "Cohatrac IV",
            "cidade": "São Luís",
            "uf": "MA",
            "tipo_usuario": "user",
            "permissao": true,
            "created_at": "2023-07-06T19:21:55.000000Z",
            "updated_at": "2023-07-06T19:21:55.000000Z"
        },
        "token": {
            "accessToken": {
                "name": "userAccess",
                "abilities": [
                    "user_privilege"
                ],
                "expires_at": null,
                "tokenable_id": 1,
                "tokenable_type": "App\\Models\\User",
                "updated_at": "2023-07-06T19:34:03.000000Z",
                "created_at": "2023-07-06T19:34:03.000000Z",
                "id": 2
            },
            "plainTextToken": "2|rPw5vARauEaNmBYzveAF06DViQc5VFhZ7KXH3r2N"
        }
    },
    "errors": []
}

EM CASO DE ERRO OU NULO ENVIO:
{
    "message": "O campo cnpj cpf selecionado é inválido. (and 1 more error)",
    "errors": {
        "cnpj_cpf": [
            "O campo cnpj cpf selecionado é inválido.",
            "O campo cnpj cpf deve ter pelo menos 11 caracteres."
        ]
    }
}


Ato LOGOUT USUÁRIO:
	VERBOSE: POST
	URL: http://127.0.0.1:8000/api/v1/logout
	DADOS ENVIADOS ( NÃO PRECISA):
	NECESSÁRIO ENVIO DO TOKEN BEARER NO HEADER:

		{ Bearer 1|avA74WVsm4ptRMm2yVaMRlcq86pXjE4mp3TlwWWO }

	CASO DE SUCESSO:
		{
    			"message": "Usuario deslogado",
    			"status": 200
		}

	CASO DE ERRO:

		{
    			"message": "Unauthenticated."
		}


CRUD (USUÁRIOS NA API):

Ato PEGAR TODOS OS USERS USUÁRIO:
	VERBOSE: GET
	URL: http://127.0.0.1:8000/api/v1/users
	DADOS ENVIADOS ( NÃO PRECISA):
	NECESSÁRIO ENVIO DO TOKEN BEARER NO HEADER:

	DADOS RETORNADOS (EXEMPLO):

{
    "message": "Usuarios coletados",
    "status": 200,
    "data": [
        {
            "id": 1,
            "nome": "Jhon",
            "nome_loja": "GarnetPrograming",
            "cnpj_cpf": "70780494313",
            "telefone": "98983344844",
            "email": "pedro@email.com",
            "logradouro": "Rua 14",
            "numero": "03",
            "bairro": "Cohatrac IV",
            "cidade": "São Luís",
            "uf": "MA",
            "tipo_usuario": "user",
            "permissao": true,
            "created_at": "2023-07-06T19:21:55.000000Z",
            "updated_at": "2023-07-06T19:21:55.000000Z"
        }
    ]
}


Ato GET ONE USER USUÁRIO (APENAS UM):
	VERBOSE: GET
	URL: http://127.0.0.1:8000/api/v1/users/:id
	:id = exemplo de id existente.
	DADOS ENVIADOS ( NÃO PRECISA):
	NECESSÁRIO ENVIO DO TOKEN BEARER NO HEADER:

	DADOS RETORNADOS (EXEMPLO):

{
    "message": "Usuarios coletado",
    "status": 200,
    "data": {
        "id": 1,
        "nome": "Jhon",
        "nome_loja": "GarnetPrograming",
        "cnpj_cpf": "70780494313",
        "telefone": "98983344844",
        "email": "pedro@email.com",
        "logradouro": "Rua 14",
        "numero": "03",
        "bairro": "Cohatrac IV",
        "cidade": "São Luís",
        "uf": "MA",
        "tipo_usuario": "user",
        "permissao": true,
        "created_at": "2023-07-06T19:21:55.000000Z",
        "updated_at": "2023-07-06T19:21:55.000000Z"
    }
}

CASO DE USUÁRIO INEXISTENTE:

{
    "message": "Nenhum dado encontrado",
    "status": 404
}


Ato GET ONE USER (DELETE) USUÁRIO:
	VERBOSE: DELETE
	URL: http://127.0.0.1:8000/api/v1/users/:id
	:id = exemplo de id existente.
	envio do :id é obrigatório.
	DADOS ENVIADOS ( NÃO PRECISA):
	NECESSÁRIO ENVIO DO TOKEN BEARER NO HEADER:

	DADOS RETORNADOS EM CASO DE SUCESSO (EXEMPLO):

	{
   		 "message": "Usuário deletado",
    		"status": 204
	}

	DADOS RETORNADOS EM CASO DE ERRO (EXEMPLO):

	{
   		 "message": "dado não foi encontrado",
    		"status": 404
	}

Ato GET ONE USER (ATUALIZAR) USUÁRIO:
	VERBOSE: PUT / PATCH
	URL: http://127.0.0.1:8000/api/v1/users/:id
	:id = exemplo de id existente.
	envio do :id é obrigatório.

	DADOS ENVIADOS ( exemplo, cada um pode ser enviado solitáriamente):
		{
            "nome": "Jhonny",
            "nome_loja": "GarnetPrograming",
            "telefone": "98983344844",
            "email": "pedro@email.com",
            "logradouro": "Rua 14",
            "numero": "03",
            "bairro": "Cohatrac IV",
            "cidade": "São Luís",
            "uf": "MA"
		}

	NECESSÁRIO ENVIO DO TOKEN BEARER NO HEADER:

	DADOS RETORNADOS EM CASO DE SUCESSO (EXEMPLO):

{
    "message": "Usuarios atualizado",
    "status": 200,
    "data": {
        "id": 2,
        "nome": "Jhonny",
        "nome_loja": "GarnetPrograming",
        "cnpj_cpf": "70780494313",
        "telefone": "98983344844",
        "email": "pedro@email.com",
        "logradouro": "Rua 14",
        "numero": "03",
        "bairro": "Cohatrac IV",
        "cidade": "São Luís",
        "uf": "MA",
        "tipo_usuario": "user",
        "permissao": true,
        "created_at": "2023-07-06T20:01:52.000000Z",
        "updated_at": "2023-07-06T20:03:31.000000Z"
    }
}
	DADOS RETORNADOS EM CASO DE ERRO (EXEMPLO):

	{
  		  "message": "dado não foi encontrado",
    		"status": 404
	}

############################### FILTRO ############################################
    Ato FILTRAR USERS POR CAMPOS (FILTRO) USUÁRIO:
	VERBOSE: PUT / PATCH
	URL: http://127.0.0.1:8000/api/v1/users?:campo[:operador]=:dado_a_ser_filtrado
	:campo = campo existente.
    :operador = operador entre coluna do db e valor a ser procurado
    :dado_a_ser_filtrado = dado filtrado
	o envio dos parametros não é obrigatório.

    exemplo de parametros (os parametros devem ser colocados entre colchetes na busca ("[]"))
    {
        'eq' => '=',
        'ne' => '!=',
        'in' => 'in',
        'lk' => 'like'
        'gt' => '>',
        'lt' => '<',
        'gte' => '>='
        'lte' => '=<'
    }

    EXEMPLO VÁLIDO DE BUSCA COM FILTRO: 

    URL: http://127.0.0.1:8000/api/v1/users?bairro[lk]=hab

    RETORNO:
        {
            "message": "Usuarios coletados",
            "status": 200,
            "data": [
                {
                    "id": 3,
                    "nome": "Maria",
                    "nome_loja": "GarnetPrograming",
                    "cnpj_cpf": "60881394313",
                    "telefone": "9898377833",
                    "email": "maria@email.com",
                    "logradouro": "Rua 15",
                    "numero": "23",
                    "bairro": "cohab",
                    "cidade": "São Luís",
                    "uf": "SP",
                    "tipo_usuario": "user",
                    "permissao": true,
                    "created_at": "2023-07-07T11:46:06.000000Z",
                    "updated_at": "2023-07-07T11:46:06.000000Z"
                }
            ]
        }
    ATENTE-SE QUE O VALOR BUSCADO É APENAS PARTE DO VALOR REAL DO CAMPO ACHADO, NO CASO ( COHAB ).

    EM CASO DE NÃO EXISTIR O VALOR DEFINIDO A SER FILTRADO:

    RETORNA:
    {
        "message": "Usuarios coletados",
        "status": 200,
        "data": []
    }


    ############################### PERMISSÃO ############################################
    Ato ALTERAR A PERMISSÃO DE LOGIN NO SISTEMA:
	VERBOSE: POST
	URL: http://127.0.0.1:8000/api/v1/admin/changePermission
	EM BODY: envia-se o campo de nome "id", com valor em formato integer.

    EM CASO DE ID NÃO ENCONTRADO RETORNA:
    {
    "message": "Não encontrado",
    "status": 404
    }

    EM CASO DE USUARIO NÃO AUTORIZADO A REALIZAR A AÇÃO:
    {
    "message": "Sem autorização para realizar ação",
    "status": 403
    }

    EM CASO DE TOKEN AUTORIZADO E ID EXISTENTE ENVIADO:
    {
    "message": "Permissão alterada",
    "status": 202,
    "permissao": "false"
    }
    ## OU ##
    {
    "message": "Permissão alterada",
    "status": 202,
    "permissao": "true"
    }





    ############################### PRODUTO ############################################
    Ato ADICIONAR PRODUTO NO SISTEMA:
	VERBOSE: POST
	URL: http://127.0.0.1:8000/api/v1/products
	Headers: necessário envio de header de autorização token Bearer,
             necessário envio de header Form-data Multi-part.
            
    EXEMPLO DE ENVIO DE DADOS ACEITOS PARA CADASTRO:
    categoria:                          Frontal
    nome:                               Frontal Samsung J400 LCD
    marca:                              Samsung
    modelo:                             J400
    preco_original:                     40.80
    preco_atual:                        30.99
    image[]:                            [imagem é colocada em file Input,  e pode ser array]
    "atributos": [
        {  
            "quantidade":   2,
            "nome":         "azul"
        }
    ]
    

    OBS: pode ser enviados quantos arrays de atributos quiser, desde que o indice esteja correto em agrupamento.


    EM CASO DE ENVIO ERRÔNEO DE DADOS RETORNA:
    {
        "message": "O campo categoria é obrigatório. (and 4 more errors)",
        "errors": {
            "categoria": [
                "O campo categoria é obrigatório."
            ],
            "nome": [
                "O campo nome é obrigatório."
            ],
            "marca": [
                "O campo marca é obrigatório."
            ],
            "modelo": [
                "O campo modelo é obrigatório."
            ],
            "preco_atual": [
                "O campo preco atual é obrigatório."
            ]
        }
    }

    EM CASO DE USUARIO NÃO AUTORIZADO A REALIZAR A AÇÃO:
    {
        "message": "Unauthenticated."
    }

    EM CASO DE TOKEN AUTORIZADO E DADOS CORRETOS ENVIADOS RETORNA:
    {
    "data": {
        "id": 4,
        "categoria": "Telas",
        "user_id": "1",
        "marca": "Samsung",
        "nome": "Frontal Samsung J400 LCD",
        "modelo": "V9-ab00T",
        "preco_original": null,
        "preco_atual": "340.99",
        "destaque": false,
        "status": false,
        "created_at": "2023-07-19T13:04:25.000000Z",
        "updated_at": "2023-07-19T13:04:25.000000Z"
        }
    }









    ####################### GET ALL ##########################
    Ato RECUPERAR PRODUTOS NO SISTEMA:
	VERBOSE: GET
	URL: http://127.0.0.1:8000/api/v1/products

    RETORNO CORRETO COM ATRIBUTOS E IMAGENS EM RELACIONAMENTO:
    {
    "data": [
        {
            "id": 4,
            "categoria": "Telas",
            "user_id": "1",
            "marca": "Samsung",
            "nome": "Frontal Samsung J400 LCD",
            "modelo": "V9-ab00T",
            "preco_original": null,
            "preco_atual": "340.99",
            "destaque": false,
            "status": false,
            "images": [
                {
                    "id": 4,
                    "product_id": 4,
                    "image": "storage/products/16897718651.jpg",
                    "created_at": "2023-07-19T13:04:25.000000Z",
                    "updated_at": "2023-07-19T13:04:25.000000Z"
                }
            ],
            "atributos": [
                {
                    "id": 1,
                    "product_id": 4,
                    "attribute_id": 1,
                    "attribute_value_id": 2,
                    "quantidade": 20,
                    "nome": "Azul",
                    "created_at": "2023-07-19T13:04:25.000000Z",
                    "updated_at": "2023-07-19T13:04:25.000000Z"
                }
            ],
            "created_at": "2023-07-19T13:04:25.000000Z",
            "updated_at": "2023-07-19T13:04:25.000000Z"
        }
    ]


    ################## GET ###########################
    Ato RECUPERAR PRODUTO INDIVIDUAL NO SISTEMA:
	VERBOSE: GET
	URL: http://127.0.0.1:8000/api/v1/products/1


    {
    "data": {
        "id": 4,
        "categoria": "Telas",
        "user_id": "1",
        "marca": "Samsung",
        "nome": "Frontal Samsung J400 LCD",
        "modelo": "V9-ab00T",
        "preco_original": null,
        "preco_atual": "340.99",
        "destaque": false,
        "status": false,
        "images": [
            {
                "id": 4,
                "product_id": 4,
                "image": "storage/products/16897718651.jpg",
                "created_at": "2023-07-19T13:04:25.000000Z",
                "updated_at": "2023-07-19T13:04:25.000000Z"
            }
        ],
        "atributos": [
            {
                "id": 1,
                "product_id": 4,
                "quantidade": 20,
                "nome": "Azul",
                "created_at": "2023-07-19T13:04:25.000000Z",
                "updated_at": "2023-07-19T13:04:25.000000Z"
            }
        ],
        "created_at": "2023-07-19T13:04:25.000000Z",
        "updated_at": "2023-07-19T13:04:25.000000Z"
        }
    }



    ################## UPDATE ###########################
    Ato ATUALIZAR PRODUTO INDIVIDUAL NO SISTEMA:
	VERBOSE: POST
    !(((((((OBS!)))))))!
    O método de requisição enviado é Post mesmo que seja apenas atualização, isso se implica apenas nos casos
    onde o dado enviado tem Multi-part Form-Data, o multi part é utilizado apenas com envio de dados que contenham imagem 
    ou outro tipo de arquivo que seja fora do tradicional json string.
    !!! Para que o método POST funcione como PUT nesses casos é necessário envio do campo  (_method: PUT ).

	URL: http://127.0.0.1:8000/api/v1/products/:id

    RESPOSTA DO SERVIDOR EM CASO DE SUCESSO:

    {
    "data": {
        "id": 4,
        "categoria": "Telas",
        "marca": "Samsung",
        "nome": "Frontal Samsung J400 AMOLED",
        "modelo": "V9-ab00T",
        "preco_original": null,
        "preco_atual": "340.99",
        "destaque": false,
        "status": false,
        "created_at": "2023-07-19T13:04:25.000000Z",
        "updated_at": "2023-07-19T13:31:15.000000Z"
        }
    }




    ################## DELETE #########################
    Ato DELETAR PRODUTO INDIVIDUAL NO SISTEMA:
	VERBOSE: DELETE
    URL: http://127.0.0.1:8000/api/v1/products/:id

    OBS: ao deletar produto, imagens adicionadas a ele serão deletadas automaticamente.

    EM CASO DE ID NÃO ENCONTRADO:

    {
        "message": "dado não foi encontrado"
    }

    EM CASO DE SUCESSO:

        204 No Content.




    ################### ATRIBUTO DO PRODUTO #######################

    ################## CREATE ###########################
    Ato CRIAR ATRIBUTO DO PRODUTO INDIVIDUALMENTE NO SISTEMA:
	VERBOSE: POST    
    URL: http://127.0.0.1:8000/api/v1/attributeValues

    EXEMPLO DE ENVIO CORRETO EM JSON:
    {
        "id": 8,
        "atributos": [
            {  
                "quantidade": 2,
                "nome": "azul"
            },
            {  
                "quantidade": 2,
                "nome": "azul"
            }
        ]
    }

    "id" => campo id representa o id do produto ao qual os atributos serão cadastrados. (sem ele é executado resposta badRequest por não saber a qual produto será destinado o atributo).

    EM CASO DE ERRO:

    {
        "data": {
            "message": "não foi possivel criar atributo do produto"
        }
    }

    EM CASO DE ACERTO E ACEITAÇÃO DOS DADOS:
    {
    "message": "atributo do produto criado",
    "data": {
        "id": 11,
        "user_id": 1,
        "categoria": "Telas",
        "nome": "tester02",
        "modelo": "V9-ab00T",
        "marca": "Samsung",
        "preco_original": null,
        "preco_atual": "340.99",
        "destaque": false,
        "status": false,
        "created_at": "2023-07-22T19:03:08.000000Z",
        "updated_at": "2023-07-22T19:03:08.000000Z",
        "product_images": [],
        "attributes": [
            {
                "id": 19,
                "product_id": 11,
                "quantidade": 20,
                "nome": "Verde",
                "created_at": "2023-07-22T19:03:08.000000Z",
                "updated_at": "2023-07-22T19:03:08.000000Z"
            },
            {
                "id": 20,
                "product_id": 11,
                "quantidade": 40,
                "nome": "Azul",
                "created_at": "2023-07-22T19:03:08.000000Z",
                "updated_at": "2023-07-22T19:03:08.000000Z"
            },
            {
                "id": 63,
                "product_id": 11,
                "quantidade": 2,
                "nome": "azul",
                "created_at": "2023-07-24T19:04:47.000000Z",
                "updated_at": "2023-07-24T19:04:47.000000Z"
            }
        ]
    }
    }



    ################## UPDATE ###############################
    Ato ATUALIZAR ATRIBUTO DO PRODUTO INDIVIDUALMENTE NO SISTEMA:
	VERBOSE: PUT    
    URL: http://127.0.0.1:8000/api/v1/attributeValues/:id

    CASO DE DADOS CORRETOS A SEREM ENVIADOS EM JSON:
        {  
            "quantidade": 2,
            "nome": "violeta"
        }

    RETORNO EM OCASIÃO CORRETA:
    {
    "data": {
        "id": 63,
        "product_id": 11,
        "quantidade": 20,
        "nome": "violeta",
        "created_at": "2023-07-24T19:04:47.000000Z",
        "updated_at": "2023-07-24T19:16:52.000000Z"
    }
    RETORNO EM ID DO ATRIBUTO NÃO ENCONTRADO:
    {
        "message": "dado não foi encontrado"
    }


    ################## DELETE ###############################
    Ato DELETAR ATRIBUTO DO PRODUTO INDIVIDUALMENTE NO SISTEMA:
	VERBOSE: DELETE    
    URL: http://127.0.0.1:8000/api/v1/attributeValues/:id

    EM CASO DE ID SOLICITADO EXISTIR:

    RETORNA 204 NO CONTENT

    EM CASO DE ID SOLICITADO NÃO EXISTIR:
    {
        "message": "dado não foi encontrado"
    }


    ################## GET ALL ###############################
    Ato DELETAR ATRIBUTO DO PRODUTO INDIVIDUALMENTE NO SISTEMA:
	VERBOSE: GET    
    URL: http://127.0.0.1:8000/api/v1/attributeValues
    SE NECESSÁRIO PODE SER PROVISIONADO PARAMETROS DE FILTRO AO GET APOS A '?'.











    ################### IMAGEM DO PRODUTO #######################
    
    ################## CREATE ###########################
    Ato CRIAR IMAGEM DO PRODUTO INDIVIDUALMENTE NO SISTEMA:
	VERBOSE: POST    
    URL: http://127.0.0.1:8000/api/v1/attributeValues

    EXEMPLO DE ENVIO CORRETO EM JSON:
    {
        "id": 8,
        "imagem[]": (array de imagens ou imagem única)
    }

    "id" => campo id representa o id do produto ao qual as imagens serão atribuídas. (sem ele é executado resposta badRequest por não saber a qual produto será destinado a imagem).

    EM CASO DE ERRO:

    {
        "data": {
            "message": "não foi possivel criar imagem do produto"
        }
    }

    EM CASO DE ACERTO E ACEITAÇÃO DOS DADOS:
    {
{
    "message": "imagem do produto criada",
    "data": {
        "id": 7,
        "user_id": 1,
        "categoria": "Telas",
        "nome": "Frontal Samsung J400 LCD",
        "modelo": "V9-ab00T",
        "marca": "Samsung",
        "preco_original": null,
        "preco_atual": "340.99",
        "destaque": false,
        "status": false,
        "created_at": "2023-07-21T18:06:54.000000Z",
        "updated_at": "2023-07-21T18:06:54.000000Z",
        "product_images": [
            {
                "id": 10,
                "product_id": 7,
                "image": "storage/products/16899664211.jpg",
                "created_at": "2023-07-21T19:07:01.000000Z",
                "updated_at": "2023-07-21T19:07:01.000000Z"
            },
            {
                "id": 11,
                "product_id": 7,
                "image": "storage/products/16899666980.jpg",
                "created_at": "2023-07-21T19:11:38.000000Z",
                "updated_at": "2023-07-21T19:11:38.000000Z"
            },
            {
                "id": 12,
                "product_id": 7,
                "image": "storage/products/16899666981.jpg",
                "created_at": "2023-07-21T19:11:38.000000Z",
                "updated_at": "2023-07-21T19:11:38.000000Z"
            },
            {
                "id": 13,
                "product_id": 7,
                "image": "storage/products/16899666982.jpg",
                "created_at": "2023-07-21T19:11:38.000000Z",
                "updated_at": "2023-07-21T19:11:38.000000Z"
            },
            {
                "id": 14,
                "product_id": 7,
                "image": "storage/products/16899667240.jpg",
                "created_at": "2023-07-21T19:12:04.000000Z",
                "updated_at": "2023-07-21T19:12:04.000000Z"
            },
            {
                "id": 18,
                "product_id": 7,
                "image": "storage/products/16902271730.jpg",
                "created_at": "2023-07-24T19:32:53.000000Z",
                "updated_at": "2023-07-24T19:32:53.000000Z"
            },
            {
                "id": 19,
                "product_id": 7,
                "image": "storage/products/16902272680.jpg",
                "created_at": "2023-07-24T19:34:28.000000Z",
                "updated_at": "2023-07-24T19:34:28.000000Z"
            }
        ]
    }
}
    }



    ################## UPDATE ################################
    Ato ATUALIZAR IMAGEM DO PRODUTO INDIVIDUALMENTE NO SISTEMA:
	VERBOSE: PUT    
    URL: http://127.0.0.1:8000/api/v1/productsImages/:id

    CASO DE DADOS CORRETOS A SEREM ENVIADOS EM JSON:
        {  
            "quantidade": 2,
            "nome": "violeta"
        }

    RETORNO EM OCASIÃO CORRETA:
    {
    "data": {
        "id": 63,
        "product_id": 11,
        "quantidade": 20,
        "nome": "violeta",
        "created_at": "2023-07-24T19:04:47.000000Z",
        "updated_at": "2023-07-24T19:16:52.000000Z"
    }
    RETORNO EM ID DO ATRIBUTO NÃO ENCONTRADO:
    {
        "message": "dado não foi encontrado"
    }


    ################## DELETE ###############################
    Ato DELETAR IMAGEM DO PRODUTO INDIVIDUALMENTE NO SISTEMA:
	VERBOSE: DELETE    
    URL: http://127.0.0.1:8000/api/v1/productsImages/:id

    EM CASO DE ID SOLICITADO EXISTIR:

    RETORNA 204 NO CONTENT

    EM CASO DE ID SOLICITADO NÃO EXISTIR:
    {
        "message": "dado não foi encontrado"
    }

    ################## GET ALL ###############################
    Ato PEGAR TODAS AS IMAGEM DOS PRODUTOS NO SISTEMA:
	VERBOSE: GET    
    URL: http://127.0.0.1:8000/api/v1/productsImages
    SE NECESSÁRIO PODE SER PROVISIONADO PARAMETROS DE FILTRO AO GET APOS A '?'.

}
}







