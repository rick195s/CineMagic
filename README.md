# TIPS

Foi usado scaffold bootstrap. Basicamente foram implementadas coisas automaticamente que correspondem ao auth de users e páginas base:

https://laravel.com/docs/7.x/authentication#authentication-quickstart

https://hdtuto.com/article/laravel-8-bootstrap-auth-example-step-by-step

Sempre que se criarem controllers usamos: 

    php artisan make:controller NomeController --resource

--resource vai criar um controlador com metodos default

https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller

Para usarmos os valores nas Rotas usamos: 

    Route::resource('Url', NomeController::class)

A aplicação vai traduzir as strings automaticamente para português porque no ficheiro config/app.php colocamos o locale a pt_PT. 
Ao colocamos esse parametro o Laravel vai à pasta resources/lang/pt_PT ver as traduções. 

Para usar traducoes que estejam dentro de resources/lang/pt_PT.json podemos usar:

    echo __('Email');

Uma boa pratica é dar nome às rotas:

https://laravel.com/docs/8.x/routing#named-routes

https://laravel.com/docs/8.x/routing#generating-urls-to-named-routes

Para gerarmos rotas dinamicamente na vista usamos:

    route('nome_dado_à_rota')

Para vermos se estamos numa rota com um certo nome usamos:

    Route::currentRouteName() == 'nome_dado_à_rota'

## Models:

### Criar Modelos usamos:

```
    php artisan make:model NomeModel
```




### Relações entre Modelos:

Para ser mais facil fazer pesquisas à base de dados e organizar os Models do projeto devemos sempre especificar as ligações que temos na base de dadosno codigo dos Modelos ORM, 1:1, 1:n, n:m:

Quando se faz uma ligação temos de alterar os dois Modelos ORM que têm ligação entre si.
    Exemplo: 



        class User extends Model
        {
            // A user may have or not a phone
            public function phone()
            {
                return $this->hasOne(Phone::class);
            }
        }
        
        class Phone extends Model
        {
             // A phone always belongs to a user
             public function user()
             {    
                 return $this->belongsTo(User::class);
             }
         }

#### Como usar:

``` 
// vai buscar o numero de telefone do user com id 123
$phone = User::find(123)->phone;
$phone->number = '99293283';

// vai buscar o user do numero de telemovel com id 324
$user = Phone::find(324)->user;
$str = "I'm calling " . $user->name;
```



### Soft Deletes:

    soft delete consiste em alterar a coluna deleted_at na tabela em vez de eliminar mesmo a linha da tabela



É possivel tambem restringir valores passados no Url

https://laravel.com/docs/8.x/routing#parameters-regular-expression-constraints
