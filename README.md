# AdminKit

https://github.com/adminkit/adminkit

# FlixGo:

https://www.templateshub.net/template/FlixGo-Online-Movies-Template

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

    dentro de php:
    echo __('Email');
    
    numa view:
    {{ __('Register') }}

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

- Para ser mais facil fazer pesquisas à base de dados e organizar os Models do projeto devemos sempre especificar as ligações que temos na base de dadosno codigo dos Modelos ORM, 1:1, 1:n, n:m:;

belongsTo fica sempre no Modelo em que a tabela tem a foreign_key;

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

ir buscar um filme que tenha pelo menos uma sessao:

```
$sessoes = Filme::has('sessoes')->first();
```

ir buscar todas as sessoes do filme que tem pelo menos uma sessao:

```
$sessoes = Filme::has('sessoes')->first()->sessoes;
```

caso a chave primaria de uma tabela seja diferente de id temos de fazer:

```
protected $primaryKey = "your_key_name";
```

### Middlewares:

Servem para executar ou verificar coisas antes do Laravel chamar o controlador.

Por exemplo, podemos criar middlewares para verificar se um user é admin ou para criar logs das ações do users, etc.

#### Como usar:

```
php artisan make:middleware IsAdmin
```

depois dentro do ficheiro gerado dentro de App\Http\Middleware existe uma função handle, e é ai onde fazemos a nossa logica.

chamamos o Closure $next quando a operação é permitida ou correu com sucesso.

Para ser possivel usar o middleware temos de o registar no Kernel, App\Http\Kernel.php.

```
protected $routeMiddleware = [
    . . . ,
    'admin' => \App\Http\Middleware\IsAdmin::class,
];
```

usar num controller:

```
__construct(){
    $this->middleware('isAdmin');   
}
```

usar nas rotas:

```
route...->middleware('isAdmin');
```

### Policies e Gates:

Estes mecanismos são usados para ajudar na autorização de processos de sistema.

Policies -> são usadas para verificar se um user tem autorização para ver recursos por exmeplo bilhetes, sessões, ficheiros, etc.

```
php artisan make:policy BilhetePolicy
```

Criar policies com operacoes basicas de CRUD para um model:

```
php artisan make:policy BilhetePolicy --model=Bilhete
```

Adicionar a policy:

App/Providers/AuthServiceProvider.php

```
protected $policies = [
    User::class => UserPolicy::class,
]
```

Gates -> são usados para verificar se um user tem autorizações globais e de rotas por exemplo.

```
Para criar temos de ir ao ficheiro

App\Providers\AuthServiceProvider.php

e dentro da funcao boot meter 

Gate::define('access-dashboard', function ($user) {
// Only "admin" users can "access-dashboard"
return $user->admin;
});
```

#### Como usar:

    Podemos colocar dentro de controllers:

```
$this->authorize('view', $bilhete);
```

    Podemos usar dentro de middlewares:

```
route...->middleware('can:view,account');
```

    Podemos usar dentro de views:

```
@can('view, bilhete')
@endcan

cannot('view, bilhete') 
@endcannot
```

### Soft Deletes:

    soft delete consiste em alterar a coluna deleted_at na tabela em vez de eliminar mesmo a linha da tabela

Os modelos que tenham deleted_at têm de use SoftDeletes;

Verificar se um registo foi soft Deleted:

```
$user->trashed()
```

### Transacoes:

sempre que duas operacoes na DB só fazem sentido serem feitas se outra foi feita usados transactions.

Por exemplo:

Quando damos softDelete do cliente, temos de dar softDelete do user tambem

```
     try {

            DB::beginTransaction();
            $createdUser = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            Cliente::create([
                'id' => $createdUser->id,
            ]);

            DB::commit();

            return $createdUser;
        } catch (\PDOException $e) {
            DB::rollBack();

            return null;
        }
```

### Validações:

Antes de inserirmos alguma coisa na DB temos de fazer as validacoes necessarias.

É possivel tambem restringir valores passados no Url

https://laravel.com/docs/8.x/routing#parameters-regular-expression-constraints

### Packages que vamos precisar:

#### QRCode:

https://github.com/SimpleSoftwareIO/simple-qrcode

#### Gerar Pdf:

https://github.com/barryvdh/laravel-dompdf

## Standards:

#### Erros e Validações:

- Quando for para validar informação enviada no form devemos usar sempre os 

- Para enviar erros para uma vista podemos usar:
  
  ```
  ->with('error', 'Mesangem');
  ```

#### Forms:

- sempre que usarmos forms onde o user tem de inserir dados temos de usar o old();

- colocar sempre @csrf nos forms;

- quando queremos usar outros metodos para além do GET e POST devemos especificar o metodo com @method('DELETE');

#### Routes:

- Rotas de admin têm prefixo de 'admin.';

- Rotas de admin têm de estar dentro de middleware 'isAdmin'

#### Controllers:

- Maior parte dos controllers têm de ter o middleware 'auth' no construtor;

- Quando queremos verificar alguma policy ou gate devemos meter isto antes de fazer qualquer operacao num controller: 

```
$this->authorize('delete', $user);
```

ou podemos meter na route um middleware can

#### Views:

    dentro das views devemos usar sempre @can e @cannot para so mostrar coisas que os utilizadores podem fazer.

##### Loops:

Dentro de loops foreach nas views conseguimos saber se estamos no primeiro loop ou ultimo atraves de $loop->first, ou last; 

#### Policies e Gates:

- Sempre que validamos alguma coisa numa policy ou Gate devemos fazer desta forma:
  
  ```
          if ($user->id == $userToDelete->id) {
              return $this->deny(__("A User cannot block or unlock himself"));
          }
  
          if (!$user->isAdmin()) {
              return $this->deny(__("Just the admins can block or unlock users"));
          }
  
          return true;
  ```
  
  ou seja tentamos sempre mostrar mensagens de erro consoante as verificações e no fum damos return de true.

#### Form Request Validator:

é possivel ir buscar um valor dinamico da rota:

por exemplo esta para esta rota users/{user} podemos ir buscar o valor {user} atraves de:

```
$this->route('user')
```

## Coisas Importantes (Extras, etc):

- Laravel UI instalada.

- Email de recuperar senha a ser enviado

- Saber quais filmes têm sessões futuras: 
  
  ```
  Filme::with('sessoes')->whereRelation('sessoes', 'data', now()->format('Y-m-d'))->get();
  ```

#### Rules:

- Rule Payment: serve para verificar os pagamentos;

#### Carrinho:

- Um utilizador pode adicionar um lugar ao carrinho sem ter previamente selecionado a sessao.

- Uma sessao unica só é adicionada uma vez ao carrinho. Se o utilizador quiser comprar varios bilhetes de uma sessao, o que vai ter de fazer é selecionar varios lugares quando tiver no checkout;
  
  O carrinho vai ter um array com sessoes e outro array com lugares. Sempre que o utilizador for fazer checkout o que tem de fazer é "transformar" uma sessao em x bilhetes. 

- Um user só pode adicionar uma sessao ao carrinho se ela nao tiver começado até há 5 minutos

#### Salas:

- Podemos permitir que uma sala seja alterada mesmo tendo sessoes anteriores se quando alterarmos uma sala criarmos uma copia dessa sala.

- Ao criar uma sala podemos especificar o numero de lugares que a sala vai ter;

- Ao editar uma sala, se aumentarmos o numero de lugares são criados mais lugares. Se diminuirmos o numero de lugares, fazemos soft delete dos lugares a mais, começando a eliminar do fim.

- Cada fila de lugares é composta por 15 lugares no máximo.

- Só salas sem sessoes futuras é que podem ser eliminadas.

- Só salas sem sessoes é que podem ser editadas.

- Número de filas de uma sala não pode ser maior que o número de lugares;

#### Filmes:

- Só se podem apagar filmes sem sessoes associadas;

#### Middlewares:

- IsAdmin;
- UserBlocked; (serve para proibir users de entrarem na web); Este middleware foi colocado no Kernel no grupo web porque vai ser aplicado sempre que um user tentar aceder ao website;
- carrinho. Este middleware vai criar uma variavel global carrinho com as informações do carrinho presente na session(). Sempre que uma vista precisar de ir buscar informação ao carrinho essa vista vai precisar de ter o middleware carrinho. (DUVIDAAAA)

#### Controllers:

- ChangePasswordController (Usado para alterar a password do user);

#### Relações entre modelos:

- salas 1:n sessoes:

- filmes 1:n sessoes;

- sessoes 1:n bilhetes;

- salas 1:n lugares;

- bilhetes n:1 lugares;

- generos 1:n filmes;

- clientes 1:n bilhetes;

- clientes 1:n recibos;

- clientes 1:1 users;

- recibos 1:n bilhetes;

## O que temos de fazer:

#### Autentificação, perfil e gestao de utilizadores:

- [x] Utilizadores não autenticados só podem tentar fazer login e registar-se. Depois de ser registarem um email de verificação tem de ser enviado;

- [x] Quando uma pessoa cria conta tem de ser criado um cliente;

- [x] Só clientes têm acesso ao seu perfil;

- [x] Os admin podem ver os detalhes do perfil de qualquer user no dashboard excepto clientes; (UserPolicy->view())

- [x] Os funcionarios não podem ver o seu perfil no dashboard nem no front; (UserPolicy->view(), ClientePolicy-view())

- [x] Qualquer user pode alterar a sua password;

- [x] Um administrador pode bloquear/desbloquear utilizador/cliente sem ser a ele proprio;

- [x] Um administrador pode eliminar utilizador/cliente sem ser a ele proprio;

- [x] Um utilizador depois de ser bloqueado não pode iniciar sessão;

- [x] Um administrador pode criar utilizadores e clientes;

- [x] Um administrador pode consultar filtrar, alterar utilizadores; 

- [x] Um administrador pode consultar e filtrar a lista de clientes

- [x] Um administrador não pode aceder ao perfil de um cliente;

- [x] Edições da foto dos utilizadores quando sao criados e editados;

- [x] Um administrador só pode mudar o tipo de um user para admin ou funcionario (extra)

#### Filmes em Exibição:

- [x] Qualquer utilizador pode ver quais os filmes em exibição, e as sessos dos mesmos;

- [x] Pesquisar (filtrar) filmes;

#### Compra de Bilhetes:

- [x] Adicionar ou remover lugares para qualquer sesssao (ver especificacoes no enunciado);

- [x] Um user só pode adicionar uma sessao ao carrinho se ela nao tiver começado até há 5 minutos;

- [x] Qualquer utilizador pode adicionar coisas ao carrinho;

- [x] Só clientes registados é que podem finalizar uma compra;

- [x] Se uma compra for feita com sucesso a aplicação cria um recibo e gera os bilhetes relativos à compra e limpa o carrinho de compras;

- [x] Se der erro na compra o carrinho fica como está e o cliente tem de ser avisado;

- [x] Apagar ou adicionar lugares ao carrinho;

- [x] Limpar o carrinho de compras por completo;

#### Escolha de Lugares:

- [x] Cada lugar está associado a um bilhete unico numa sessao, ou a zero bilhetes quando o lugar ainda esta vazio;

- [x] Quando um utilizador adicionar um bilhete ao carrinho, tem de escolher o lugar que quer;

#### Historico, recibos e bilhetes:

- [x] Registar o recibo após o pagamento da compra;

- [ ] Enviar o recibo automaticamente por email ao cliente;

- [ ] Recibo tem de estar sempre disponivel em HTML (POLICIES);

- [ ] Gerar recibo em PDF e armazenar permanentemente (POLICIES);

- [ ] Sempre que é feita a compra os bilhetes são gerados e sao enviados no mesmo email que o recibo; 

- [ ] Os bilhetes têm de estar sempre acessiceis em formato HTML (POLICIES);

- [ ] Sempre que o utilizador clicar na opção de fazer download do bilhete, um PDF dinamico é gerado e é feito o download do mesmo, depois disso o PDF não é armazenado;

- [ ] Os clientes devem ter acesso ao histórico de todos os recibos, sendo que podem ver o recibo e os bilhetes em HTML ou descarregra em PDF;

- [ ] Os clientes têm acesso a todos os bilhetes válidos (os que ainda nao foram usados);

#### Controlo de Acesso à sessao:

- [ ] Os funcionarios têm acesso a uma página em que escolherm qual a sessão que estão a controlar; 

- [ ] Depois de escolherem a sessao que estao a controlar o funcionario pode ter acesso a um leitor de qrcode ou alterar o estado do bilhete manualmente;

- [ ] Se o bilhete for invalido a aplicacao avisa o funcionario.

- [ ] Se o bilhete for valido a aplicacao deve mostar os detalhes do bilhete e informa que o bilhete é valido.

- [ ] O funcionario pode ainda clicar no cliente e ver as informações do mesmo, foto, etc;

- [ ] O funcionario deve ter um botao na aplicacao que ao clicar confirma o uso do bilhete, colocando o bilhete invalido;

#### Administracao do negocio:

- [ ] Os administradores podem gerir filmes, sessoes e outros valores que estao no enunciado.

- [x] Os administradores podem gerir salas e lugares de salas;

- [x] O admin pode criar, alterar ou apagar (soft delete) as salas.

- [x] Para cada sala tem de ser possivel definir os lugares que a sala tem.

- [ ] O admin pode criar, alterar e apagar filmes sem sessao e sessoes.

- [ ] Para cada filme deve ser possivel fazer upload do cartaz:

- [ ] As sessoes so podem ser alteradas ou removidas se ainda nao tiverem nenhum bilhete associado;

- [x] Os admin podem alterar as configurações do preco de bilhete e iva no dashboard;
