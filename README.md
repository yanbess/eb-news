Laravel based

## How does it work (Laravel 9 based):

1. Request goes to /routers/web.php and call action ``main`` in the controller ``/app/Http/Controllers/NewsSearchController.php``. All the request data is prepared in that action method and object of class ``/app/Http/Resources/NewsRepository.php`` and method ``getList`` with prepared data is called.
<br><br>
2. ``/app/Http/Resources/NewsRepository.php`` is responsible for getting news data from some source. In this case news data is got from e...bot API using ``/app/Http/Service/EchoBotAPI.php``. And controller doesn't care about where ``NewsRepository`` gets news data.
<br><br>
3. ``/app/Http/Service/EchoBotAPI.php`` is responsible for any request to EchoBot server. It implements the way how to request to the server. So ``NewsRepository`` doesn't care how and where does ``EchoBotAPI`` get data.

## Installation:

1. Clone your repository on your server and run command: <br>
``cp .env.example .env``<br><br>
2. Assign variables:<br>
   ``ECHOBOT_API_URL`` and ``ECHOBOT_API_ACCESS_TOKEN``<br><br>
3. Set your root path in nginx/apache setting to ``/path_to_project/public``

[More information how to install and configure Laravel 9](https://laravel.com/docs/9.x).
