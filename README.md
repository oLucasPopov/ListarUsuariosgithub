
<p  align="center"><a  href="https://laravel.com"  target="_blank"><img  src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"  width="400"  alt="Laravel Logo"></a></p>

## Configurando o projeto
Em um terminal, execute os seguintes comandos: 
- git clone https://github.com/oLucasPopov/ListarUsuariosgithub.git
- cd ListarUsuariosgithub
- composer install
- php artisan serve

Após isso, o terminal deverá mostrar algo assim:
>   INFO  Server running on [http://127.0.0.1:8000]

## Utilizando a API
As rotas que a API comporta são as seguintes:

### http://localhost:8000/api/getGithubUser/{githubUser}
Esta rota tem como objetivo listar o usuário e dar um resumo sobre seus repositórios públicos.

O parâmetro ***{githubUser}*** da rota deve ser substituido pelo nome de usuário do github que será pesquisado (ex.: filipedeschamps).

É possível ordenar o repositório pelo número de estrelas que ele tem da seguinte maneira:

    /api/getGithubUser/{githubUser}?repository_order={asc|desc}
O valor passado para a query ***repository_order*** deverá ser ***asc*** ou ***desc*** (sem chaves). 
Caso nenhum seja informado, por padrão será ordenado como desc. 
Se for informado um valor que não seja ***asc*** ou ***desc***, será retornado o erro  `401: Bad Request`.

Os possíveis status de retorno dessa rota são:
- **200**: Tudo ocorreu bem
- **401**: Algum parametro não foi informado ou foi informado incorretamente.
- **403**: Proibido. (Ocorre em caso de ser realizada muitas requisições em um período de tempo determinado pelo github).
- **404**: O Usuário informado não foi encontrado.
- **500**: Erro interno do servidor

Segue um exemplo de retorno `200` de uma requisição para esta rota com o parâmetro ***repository_order=desc***:

    {
       "id":4248081,
       "followers_count":27924,
       "following_count":299,
       "avatar_image":"https://avatars.githubusercontent.com/u/4248081?v=4",
       "email":null,
       "bio":"Vou fazer você se apaixonar por programação!",
       "repositories":[
          {
             "name":"react-hide-on-mouse-stop",
             "stars":2,
             "url":"http://127.0.0.1:8000/api/getGithubUserRepository/filipedeschamps/react-hide-on-mouse-stop",
             "github_url":"https://github.com/filipedeschamps/react-hide-on-mouse-stop"
          },
          {
             "name":"bytemd",
             "stars":3,
             "url":"http://127.0.0.1:8000/api/getGithubUserRepository/filipedeschamps/bytemd",
             "github_url":"https://github.com/filipedeschamps/bytemd"
          },
          {
             "name":"api_enem_microdados",
             "stars":8,
             "url":"http://127.0.0.1:8000/api/getGithubUserRepository/filipedeschamps/api_enem_microdados",
             "github_url":"https://github.com/filipedeschamps/api_enem_microdados"
          }
       ]
    }

### http://localhost:8000/api/getGithubUserRepository/{githubUser}/{userRepository}
Esta rota tem como objetivo detalhar o repositório de um usuário.

O parâmetro ***{githubUser}*** da rota deve ser substituido pelo nome de usuário do github que será pesquisado.

O parâmetro ***{userRepository}*** da rota deve ser substituido pelo nome do repositório do github que será pesquisado.

Ao alimentar qualquer um dos parâmetros incorretamente poderá resultar no erro `404 - Not Found`.

Os possíveis status de retorno dessa rota são:
- **200**: Tudo ocorreu bem
- **401**: Algum parametro não foi informado ou foi informado incorretamente.
- **403**: Proibido. (Ocorre em caso de ser realizada muitas requisições em um período de tempo determinado pelo github).
- **404**: O Repositório informado não foi encontrado.
- **500**: Erro interno do servidor

Segue um exemplo de retorno `200` de uma requisição para esta rota:

    {
      "name": "video-maker",
      "description": "Projeto open source para fazer vídeos automatizados",
      "stars": 2335,
      "language": "JavaScript",
      "github_url": "https://github.com/filipedeschamps/video-maker"
    }
