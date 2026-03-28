<?php
namespace App\Controllers;
class Home extends BaseController
{
    public function index(): string
    {
        return redirect()->to('/login');
    }
}
```

Guarda y entra a:
```
https://beige-elk-242672.hostingersite.com/login