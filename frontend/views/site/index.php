<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\LinkPager;

/** @var common\models\CategoriasProdutos $categorias */
/** @var common\models\Produtos $produtos */
/** @var common\models\ProdutosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

if ($warning = Yii::$app->session->getFlash('warning')) {
    echo '<div class="alert alert-warning">' . Html::encode($warning) . '</div>';
} ?>

<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary">Bolos e Sobremesas 100% Caseiros</h4>
                <h1 class="mb-5 display-3 text-primary">Bolos & Sobremesas que surpreendem.</h1>
                <!--<div class="position-relative mx-auto">
                    <form action="<?php /*= Yii::$app->urlManager->createUrl(['index/shop']) */?>" method="get">
                        <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="text" name="search" placeholder="Pesquisar...">
                        <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Procurar</button>
                    </form>
                </div>-->
            </div>
            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active rounded">
                            <img src="../img/bolos.jpg" class="img-fluid w-100 h-100 bg-secondary rounded"
                                 alt="First slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">Bolos</a>
                        </div>
                        <div class="carousel-item rounded">
                            <img src="../img/sobremesas.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">Sobremesas</a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Featurs Section Start -->
<div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-car-side fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Entregas Grátis</h5>
                        <p class="mb-0">Grátis num pedido acima de 30€</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Segurança no Pagamento</h5>
                        <p class="mb-0">Pagamento 100% seguro</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-exchange-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Reembolso</h5>
                        <p class="mb-0">Reembolso do dinheiro </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Apoio ao Cliente</h5>
                        <p class="mb-0">Em dúvidas ou problemas </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featurs Section End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Nossos Produtos</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5" id="produtoTabs">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill produtos-link" href="<?= Url::to(['site/index']) ?>">
                                <span class="text-dark" style="width: 130px;">Produtos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex py-2 m-2 bg-light rounded-pill" href="<?= Url::to(['site/index', 'categoria' => 'Bolo']) ?>">
                                <span class="text-dark" style="width: 130px;">Bolos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" href="<?= Url::to(['site/index', 'categoria' => 'Sobremesas']) ?>">
                                <span class="text-dark" style="width: 130px;">Sobremesas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                <span class="text-dark" style="width: 130px;">Bread</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-5">
                                <span class="text-dark" style="width: 130px;">Meat</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <?php
                shuffle($produtos);

                $count = 0;
                $productsPerRow = 4;
                $maxLines = 2;
                $currentLine = 1;

                foreach ($produtos as $produto):
                    if ($count % $productsPerRow == 0):
                        echo '<div class="row g-4 mb-4">';
                    endif;
                    ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="rounded position-relative fruite-item">
                            <!-- <div class="fruite-img">
                                <img src="<?php /*= $produto->getImageUrl() */?>" class="img-fluid w-100 rounded-top" alt="">
                            </div> -->
                            <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBUVFBcUFRUYGBcXHBoZFxgaGhkXFxgXGRkZGRwZFxodIS0jGh0pIRkXJDYkKS0vMzQzGiM4PjgzPSwyMy8BCwsLDw4PHhISHjIpIikyMjI0MjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMv/AABEIAM4A9QMBIgACEQEDEQH/xAAcAAABBQEBAQAAAAAAAAAAAAADAQIEBQYABwj/xAA9EAACAQQBAwIEBQEFBwQDAAABAhEAAxIhMQQiQVFhBRMycQZCgZGhIxRSsdHhM1NigqLB8AdDsvEWJHL/xAAZAQADAQEBAAAAAAAAAAAAAAAAAQIDBAX/xAAkEQACAgICAgICAwAAAAAAAAAAAQIRITEDEkFRE2EigQQycf/aAAwDAQACEQMRAD8A2Pwi+IKnR5HvVlccAGao7Fg1JKH3ryGz0GsjLtstUC/bK81bImooFzp8zh6/4ChMdlM5oc1oLvwZI0SD68j9RWevWyrFTyDBqhp2GoL80uVCY02BI6e7j9qlr1gAiqzKn2X7hNKgLu11eog1H6kM50uhRekYbqw6e0XBCikguihe2RyKbFWnxLpmQCR+vIqrZq0RSdnGkppemF6Yxz0JqVnoTPTSA5qYRNcXp1pxNMTHW7TqQy8qZq//APyZQvchy9ogmg9N8OdlmAB4kxNUnxFChKsIPpSTtmTpgfiHWNduG43J4HoPAqLTCa7KtADW6IwoCGimgBbVqasLCxS9BYkVYt0hiolIdFb1DaqL/YLrDIISKuU6LuE8TVrjFJclaCiJ+Gegt/JyZQWZjMgGI0Bvj/Wkqm+L/GnsXStpoDAFtT3V1V+TINN07ipOQqswI4pGdvWuZxs0J9x6r/7aLbhjscH7VGvX39ahO080KLQzTj4laMQ4348/tQbigk6G6zoSrfpuqYjYn3qurZNUQ+r6UKxjjmq25o1f3bc7NVvUWN1bVDTICmnMaN8uuZKVDBJfPqa1f4e6gNbInuB36weDWYFsVI6YlSGUkEehinRMso2HX9NnbKzE8ViuvRrblW5/gj1FbS11Adcgf9PY1mfxC6vcEbxEE+8zTJg2sFK1+h/Pp5timYCqLs43qE16iFBTTbFNB2GfNovSks6qBJJGqaLYqd8LIS4rHjYPtIiaTFZt1TWjWO/FV5TcAHKrDfeSYrRnqFCzmAPWax/XkO7N/eJNKOySsy3SzRvlinranxWgCdJayqcnRMzBV2SYFH6HpYqz6aLdxWPA5/URNGwJ3RfB8RtgT6RqfvTrjASDyKmt1KKMiygesisb8V+MF2bAQDwZ3HEx4qHCwUiyudavrVd1vxhlEK1ULufU0BhTjxJA5g77F2LHZPmup8UtbkHogp5WpL2N0QdLquSi+xS9TbqF8urvqulNVV1caVFpgxbqx6RAKqm6oCnJ8RiqQnk0BUVD6i2KgD4rTT8Rmk7bEsD/AJG6a1mpfT3A1J13VW7aZuwAH6k7iABsmfApXkoj2+mmpdno6hJ8b6ZWUPcjITIR2UeIZgIBnUc1Du/i0DSW5loUyT2624HHO4OtVokyaZfN0oqF1PSVnz+LrrHtCHFWkKDixEbDHeuNCN/rTE/EVzh4JJ1IknRMALHb7xRTDqyzezQTaqh6/wCKG46gnFhJCiAVPAaQSCpE77hMeRUW7eOfazAMYiGkwQIJTYJ5kkSOfWmV1NKbdd8qs6LjKCQ3b9RYO0kzsPyBAnQk8felu3rj95LKNwdYspgCCssImfvVB1NNbtrxIn0kTVhY6OsGy4ASGlYIAYuZ5MsdmJjxzxUleuYEAHUTEz3ewUk/9IqWHQ279EKidR0lZa78TZQ03LogbILADXJ1rY+26enxK6RAuNsziQZg+cu4gfcQPalkXQvE6XdS7HTb4rOWPi9xCNm4J84S3HB1oewNW9v8SWgJuDHcEg5gH30I/Whth1L6wgFHZAarrXUBxkjAg+lSreVERMB1XSgiqi90laF0NQb9k1aZJnbvT0I2atr9k1H+QTVpiKs2q6rE9I3pS0dx0egz3VNQaqCW76ll9VlFkSQ28ois/wDFrYgkVZXuq3FV3XtKmk5Jlxi0ZHq33TbKFq74gIahn4ktlJKOx0IUak6Ek6HI8+amn4NFlkl7OPJjU/oP/sVEfq7akjMEjRAMx9/4qtfqi5Ny7mpDQm5OzsAiQOOPvqhWihydRuCBccEMpMj9R68Qd1SjWyqRZn4o5IVbgWZ0JmPJbyNcCPNQnMnKA8GAdLA8CGUsZ9ufuaHbV1YE4KgjJiuLE49zj03rezGjRcywlUxwXIEkwGIOtzJBgFvER5qqAYtwAGVCgEEduIgHQAMNz5xig/IJYSsgtpiFb6jOQkH9p/eh9KnaXAtkwe4MzrMgsByq6PiJ5gUSw6GBcuoTsqGIdhuSSJAAAmJPpTAezZbCGBIIkgRzJCpMkkAwDXW1zaAFJWJgiV8wDiDHuTPtSm52sqC2qR2sACDH5nX6cT96att4yS4EyxAK2lxnGXAle0aOieYH2SAIOngMMhDTyh0ZGpMkgzMmfahfP+XpUYtGgDOXqMoMxz4FDt3nAUh3OREyC5VSIEBRAkyd8AaojlXLzAt6LEqGJOUfmU/tv9KYxthBnIEqScmbYED6VyyJbzAPj9KaLmWS5wi62YQkiQrM05HUkrAn1pzviMktlmbJVHcqhOYPBIgaga36023df6isIQACJdgfBjfodn1O6BHOzySe63Elu0gQPBxggb4+/k0TqOnBBAgkwIIgDMeqRPBJ/XxSuWKjShmBljBMBpglQJkYmNcbPNDa4yhcGRRoBgySZMlZHHieSfFSMfElQWOIJBYg/LJgQstOoBOh/wA1JdtnJlGUMTmTb0ynnjf2kn7bpRaYswa45YYkjlRucZUBiniYj1oyIZY4uI7iYJSfbGC3JOwf+1AIjX7n5LhU+QgKgkgyBBOwPceOBRYyAnMkgHGYUA9oyEbAjYYE7H2qPduztROUrEssIuOkw36+J0dU5OoZmNvHIYSW70BBjlADif0ExNAEnpXW28jXIyUYKrR9K48+f1/jQdP+LfllVuqDOgRpyfsJE/rWXtgqmPy0VRBYPcbGIA4A7h9iRv1pen+Xix7CARBTMkTJ/wCU6Jj09BR/omrPS+k+MWLoOFwSBkQe0gH1mitia8uXq2YdsAZSzNkFkaHcBv3MRXov4b+JWeodbDI1u5gNrkyM68xI4xg+g3viqglox5IuOVo7qLYruiRaver+AuB2EN/0n+dfzWev2ntN3KV9iI/b1qmuuxQqWmWJtr6V1Ql6smurPsi+jLx2hp8113qtVF6y5Bmoz3ZFYub0VGFgm6uTQvivWi3aa4YgRycRJMc1WfGviAtKcYyiZJEAzA+55MR4rPfEOpdpF5kYiDiTMidGApjxsCPcVcIeWXKgvU/FFcqApLNvt4iYBOpANVqta+Zg0i4d45M/YSDgSZj6cjRC5K5A/LtxGShcFgRAYj9jjqhqkwc7ZAG2IVoM671bWp2Nb8RWuBUGudRajVwr4AVQcSdSVCAjfn2HFK9wwShXNiBk6sCEgcDCQZA0ZGqi2VDZ5MhH5PqDFjH1MSTJBgAE8UxQs7QlyJYiHKyNySQF2IGUzEmdQDC9NcM5ElAJkPw06k5GT6bA5NM63FgAtsiI3ipUDUKFMmfcapMLSkAjJiRt2bZxkwvggRqYAPNFFu4SWNwBlWCFNsqBog4EHu2P25ooQwWyyqR2mRk1wITDCQFVl1ocQPWjhmhSrIVMBeyBBgSwmN+ugOd0iXQCcnZ1A5Z7eEwScwsncedbGqAnWvLEOhyAY4PJCTuVZfQAQI/SgZJNotcxkMCfpa4shV02CoJ1zJMyBqmJaZZy/qGCUAiGjyNBZEeTP7RTEDFyihgR3LLuQdk5BRw2/P7UQNbS5IwUkMWwMH5gImH8jIhYiJP3hMEDa46KXuOSw7Vt9iqWI0pxkgx5JOuaal4xkzC1xEw68iNwCx9I9OTXXLyBwLlwzGIJPaCTJ7U0p8a4AkkzTeolskMF0IxZbJbEHQ7m7TMaMU0hWFsvKymVx5BI+nIRBOxocaA0Tuhv1BnuWI1kVwmOSgZpMD8vmOPFBtXVP9NvmZSZYRbuKJIgxzMHt1qlNpraKqAuuRYrslidDJwCE9ef2pUOyWqs+RLF2+neKYmByCWPEaifNK9tpVihY4wCNBfEBmHO5MD9aUK52FbxIGidR2yxPuNgQBMzFRGutIAXAnn6Q2IYTlcYSxMxx6ndCALOANoW8lgjbhJEQSqqCVUczI/Wh3FVXEBBkMIWQIEcQDERjA0d0isEU/7JUYEW3wd2fZ1EkRonXrS2biSjC40NJDGFJCEg6VeOeSDqmIN0zAl0dGxI2LisuU+QCxGWpjR5oPUYrgBbWAABldAcBZMwJ0PcnxRRfMMVUs+pGRMZQIJiQTzEe2vMXqXRQzCQ2gQowRVP5ZVCTOz6/agGGDfS5YQxk5SxcxAC7O43PI9pik6OwxEAsCcSDkZg7ZQuI9ZkCeKFFtgrOmQAC28S2JMEkCVCqoidCaVepNxskQJHetwooBHABIk4iDCiigbJfxi5auO3y0um22OLC2GudvPzCCOTPI2Ipnwzq3tXA9tntspBQm38slg0GRJBBkA8fVVt0HRMbBe4TbIU/LRXTN7qkADBhIkSTkI4g0B+kCobnzJkQ9oi4txW1i6tbnKO7ZYSRERTEmeu/hP4s3U9OHcLmCVbEggx5gcTPFXF60rCGUMD4IBH815N/wCnvUuesVFdkTB2a2WJzECJBmTPkwdfpXq6vW8H2jk4eSPSRVXvw1ZYyMl9gZH6TS1cZ11HSPoXyT9mA65+4iq/4n1LWbYcgjMHAnyR59Y2N1tPh/wEA53YZuQv5V+/94/xWL/9RrOXVL3wq21UqoUtssTs8CP/ADdcseBpXI7VzJy6xMf1YRz3rODTKjJQ2gS2WiZA58Hig9VchgqBrrAJkSwBgziDwMo/4fG6Ud+IQyAy7YziDwQo08EmAxgelI9+4uJZP6YBgg4nnhsyAFHjf2Maqywd3DMM6tjbGRlmZlLfSgUEAE+Yk7/YiNBnvC7a4pt/L5PAVhEbGgSfeka9dCk2w0ESCTkYOuxB2+gEtTL1tLPflBcYBA2muNGbSdQvrA3NAh0Nm3ykCoBAnS3YPcR4xA4HvRe6MvmIpOQW2SFQgQoBHJ9f41TraEgF7aBpGWQkqFACszAgA+f21QRdt/TOETgNq4n8y+ob9xI5pWMGtpgjAszOxIYwFyVm2UkSPAnfiCKNftIqoJ7AQGGb8xCrhtfT6jFK/UxFzVtFEEuYa4BsBWGxLRxPmn/LDMA6usAOuy2w0jIyfmcDtiiwE6PpnWJf5mRmILKB+VkPto71E053x2Tw4zkFVLbgkKAGM8E6HNR+pU8KSibII+aGAnfb/dEgQdb9qI/UYJlcDRvFeSAJAJuExBH5dnikx6OvgkGWE5s3bcAbYgrk7djCV4NOW4Y09vsByLObrbWJBYnEBjGwNCeKWyUVWz1kwhQZJ0YxLKBMAdoMiCPWo/WKA7IHIYdrAH/aSMTJJgNyfaBE0xDenS0qEKpdhJKJcUpAgCYI7TPuZFHuIu1JhQISbhAaYYKdCOdb9qZb7ZJC9sJIlDkYKq2R2YmOTLUR8j+VSiyFBMEn8wYso8yTBP280DQNrgYg3MRBUwuWW9Ich+aPSRqi2rsv2I5EHbPg4/vFA4AMiN6plm42SjHLYZwO8AnU5HS78AmKF8xSmHzFQ5FiUJzBVtwBJIADSSNzNSIcLMSAgA7g9w3FDgORJxDEFgAO4tOqWzdQFxbYuAI23zD/AKiROjTXQkmUm2QCGScmJiCSra55g/xTrXS4YfLvfLQxgiEFnmWnLEMf50ORVBYdupm2CVYOVjEk5MvMqwMA79jOqFfMM0IiIpg3Lk8aLRIgjkaJ3TGRoLCLoDqSezJpns7z2Ea9eYgUwdKwufRcLEf3lZQcRAIOOh6HRnz4SAKWWP6alS4LbAGQH5iDPkT3cffVAXp8UycoNsxhC4mTpgsd/vqpHU9SUycMoMqA30D6QSAYOZ2eB+1A/tdy4mQt/M2ykG5BAAjYUAsvIndAWI3xBbwKLEeULsgYHklVHt611u5bWQBbVoxRwItGeVbEmCR5PNcyOg0vynYxkIuNs8G4WZgInhRUjp1Bf5gCNrYhGDEEdlwOcmHMgwNU8IWSTf8Aw+EtW71y9bS44ZunRADliQD3sQo35JJ9qqeq6ksPl3MlOu/tKsQ2QNwKAeTyKufh/wAUu2i9sojW2tlFRjl245f01BOMFh9Lc1W9N1wU5W1t/MXhGUlgfUBzjI8apkqy6/CVln620UwmQS35lRASVG4bjkD81ez5V8//AAzqrhu23DxcDgy5CEw4bZjEjRkzvde8h614zl/kXaZIyrqBnXVqYE9m8DmvMPx5btt1JKBWcoBcJEgMMis+hI0NjivSmU4kjk/4V47+MLx/tV4KmTLiFVjC5Mqgnnc8QN8+pqJvB0fx1+Rm7FoopxhXcswVGK2yIVfrbmCx/miu3ymR8MnxiPmMxzjFx3HtQbkxU1bLwblq2bjJCNcGQRXOiuegV/4Qsfaoygs8DjAgYkMouXDJRdSRqdmKxydYM9ZcxDMOWARVhQB7M5kp+kcb8UkENBcNMQDDsrEkaITG3+X6hT7PUF3YmQ6qxKqQSII7S51kdniNa9a67dQBe8NJnEhAJ9SF0TMdxkehqSgXWXnl8kABddMHM4iCIETB48GdGafY6f5bHPAQwMAFIAG+CSWA8sTP809riOcgzXXA0VGIMH8s9p0NmfehdZ1TsnfbKlpBEC4zqNCFB2RqZ496BA5FzeGVuYQkgxsjaxigESWaTBEc1JK7LW7ZXEQjNIDoF/8AZY6BIHPpx60GVCG4MmOI72DLi0lZUssCeIVTxTnVQwuMWtsyhWZiWJJ3gQJPjzGt0ATbJIcBQJKhmaVdiCNYA/Sd+wBnRmairbC3MrhUxGbNBJ3psFGt6Ekj0FAW6tyQc2ZQYuYujHgyoQQE1zlMClfqLrgFgjdnCwwgnYuEySpI4HMe1GgONoQ7C3cYBiQrQAs/W0MchIBEkedD0Klw/TeCgASrHFrXhlKiVaRIAjZnmkbqlhVVDcy7VRMltlog7du9J3xGt0+30y5qe4OyntAEvIPc1xG8mAJ1xqmIEZa2Bq3sspQhGuOSVJeZxJB9Z+9OexjpFWQIVyCwUD6iQBJYkGS0eKHb6ZnSCpt5g6aXUKx/McSJ7R6RS/C0VC3cBimnyDDET2gckbJ1ERSYwtkoiKouJLmUxG8uMwvPOUmNfpTkuMiwjqZUsXYs0Y9pIM5ED9vtQjaF1ijopTL/AGk4w5EyqnuCnyATzSdT0yMzMGFw2yFdNKLYI4SBoDyeCeYih0ApssYA+YdTKC2oJMQGV4GMGdzQx0pwcFyPLtkAEUD6clJVdkHX7UPqeqtvc2qlslCiIuEiArC4HKrEHQ9J805wH/pLLKrEFLjkDLn0yfZYwD/jQgCItorkgGSpCmVBnERlsBmGM6j/ABo/UdV8soxtnKIJJCrIA7fEHz5EDVRLl4BDFsIrMVe4U+kpokoWYxJGzTOkLpmHuM1uQiZKWDeOCAQCswRrVFBYZLBLFyCwee9YclCAB3eBJM8DigdJYW4+5RmUABCBgw9CuoPv7UW7dV0HymOSFrcoSYDd0iNkGB4MbHimW+qY2iri4HDRnbBMnmCOV/UetGSWx5NtXXIsxYgK5dCWA1sA6UxsQB60YdZbZmhVtzIb+p8t0hmOCog0qyY1EVCs9QpQ9oUSVMYmR27eYle7cb58UzqAiXDdVSUA7SpHuAWEziYY+9OvAWP6n5k/WzYmbZ07g+BIE+eCINRUf6g+8gSCRBDKe4eo1TbzsoDSAwLGWEDE/SIiVEn9PFOs3Ve2OGbuLRyMidD244qorBLYyx1GN1NfmBZf0Hj08V9AfCuvS7bDrr1HBU+hFeAvaBdG2CV20wASSde8amtd+Fvjj2rhLFiMoZYmV158kAz9iKHLq78eTOUO0fvwetk11MsOHUN4IBH2NdWxxlpYuhh7jn/OsF+OvgKo39qWFXa3AqgGWMhyfXkTHkelanODNZf/ANRXa708Fu0TFsAy9wwFZm8KAW16kbolo142+xiOguq+NnIpaEtgRvg4/NIElcp99H7Ulz4UbdxXJVskzDhcZcnwuXgehHIqthWHaVbMD5g47bcggeok/wDVROi69GtrbIystl/TLbGgCCVkrESPXg1GHg7Rl66QjKmMhgXQMA8RJ7pOUMV/bil6Z2JZZMKB3JGLuVBAYmQpnwI/mo3UNYEJbRhGiWjc+gHA45qQ0Wvl6JjJ8VbHIngNGiAefMj7Tm40UmEti5c2VZWOJVYKqmjEvEHgmANk0V3JclkkaUHDMOxBMoiyY4+o1FF9VIKo2JZn5MAhZYKsktPqfU8Uli5m2DQCDjBUq0kElUHawAjmeR4qaCw93qrVs6wOIBDBcrmXDKecTz53PtTbrDElmRgCSpf5j4qRID22j5ZiBkZH70t64kW8XCTmciOwtbJEEEyo5I3yBUd7rYuRiTcKrJB2wAHaCJJiCFGgZ3xTAf8AMUIkmCwBYKMAvJAZRyu52YMa8UvUXG+YOzHHhUQPMjRLOFVSANDZ3Q7nVPCqxBK7D7z/AFA7T96kEXBbBa3lAAEggFV3LPlJ1oiN0tAAbqHK3DbuEZBcsgMRJg44xBJlePyndTGdFZVLFHtq+zITAnmD9QUTA4Jxqs/t1zHEMqDw3cCo3EGdASf9adeYtgjXAxZQYBuSyEbYs4xUQJjxTEw/T3Ve3gq5IVIVA83GQvLEzG9AHwMj7V3R9S04/SwH9TJbvaAYAWCBxoADx55oN5iLahVVgQxuSA6gloUTESI5EetE6nqUeIyDOqZ4t3KQWQqgYiATB0RrdAWNS8jMQz3C6/S7qWRC07OJ+rGOeI4qV0/So7Zs63MlYZh2UtB2o4xJ8mRQbfSlrfcGACswxYAORCiSrSw1HAqNdLqikOttgoi3k9tdTJCBQGYxwDFGHoNEjqunulAZCW0CqrFresZ5ddTvx6CiDqbrTL21RzibgLDtEl8JPne41NVdi6yqYJljkZLAEyD9IOMaOo81LFwEi5cLIAT8tR9UTLBYEbJiSdUqFYnV3LjS+o1GFxTIEbG5lzE61FO+cqNld+cSxClTiEmB2hSNRPjXvReqsm4Bc7NzigAleO1WBOQ3JOhM1WkIAUuLIUQGEFbcsST28z9zO6aQOQa71NuUS3kttiw7pPdOWQJ+/wDIol83LaiWBU6+ZJZojWWsgv3nmfQ0jXlS3bhQQ6Hu8hlPafcDX7VW9RfP1jIt6lu0CZKgDxzqnFWS2HcuxkYlQwLYQVGS47jwR7aoaXWhrZhVxVCMZ7RvL1n/ADpei6tVttcUQwYBlJyDKVhp19J7fOopl2yquj23gZbkzjxCzw0b/QVZP2hp2ROx9JPkgbz/AJp79MQQAQBG49iDP/ng0e/d7kzgAnuHKjxI9jNACG2GyJhj42FEwrTPHI+1F4CqZKwElZAxaCCeQW7fQgfY0vT9QYVjLMCAd+kqVJ9Z4meajPayLk4hioVlmQViVIHMjR96nfDeptu4GzkCCpWQ7doyUbA4jdQ1gaZ7N+F3J6W3M8akQYnUzXUnwC2FsJamWtgBtECTvXgn1iurSOjlm8k241Zv8Xj/APXYgSw4nf8AFaS4Kzf4tWbJiefH29PNVyP8WLj/ALo86KlQ1tYhiSPJgFSd+IyOvagsHRFLBFZQc20JTEgBo5aD7e/ipltySWibgUsQAR7gQdmYj02arOrAZrahZxkmGJQnUyfRT59qzO4D0SB9zAEAknuBMQPfZ+9GdnfO4Ssu0KD9TC3I0f3/APBTfrlGgpOUrkrMYYys8gMePfdMuoSUDCGx7J7RETAP97j036VTyTdC2OvfICQuK4QVnEQQSZ8nJpqyV7Vy2zXWuPdLSpQSo8E4JEkjUmqhgoBe4hFyAF2VJJbEM0iCOd0idUEJwZlRoBEj5iHiQPzCfSkCfsnp1rKuNsEKGiGAzCwOCRC/aKTppZo+YlsbC3LmggJkwVBIJkAkA/oKg3Lji20tl3l8/JA7WkeDscjx7UO6AIBJLnleYHjjz7UlFA5mj61Vtq+Py7hVkR2VxjdIMtgJkrAnICN1G+E9G1+4Es2fmR3MLhAUKNSXBhVBIkkelVfTXUQ/1FJIIGJOP3yB3I8D3pfiHxRmzRTijkFgs90E4hvUCeJjzFPrbE5Utlx8Y6JundiERVkBWNy3cgnkoqMS4HqePSn9J8H6zqLZezbe4Gi2HGFtHW3IEB2DmeWgVliGGWtrOWvTng1Nt37ltbbFAbdwErskKZxy/wCF9UdUhdn7Lfrul6m3cNu7bQsiktalwttU5YlSAynmePSg2hLKXtgK4JgJgiqu5Vif6k8bA5FVq9aziVuXDcxaSzTKzGBkyREUBA1zJjJOi5J9dSZ3FLqhqTVGoe3buhvnXzYUbWASrtMi3CkSqqoGcwGbzxVe10qBC2haXu+tn7j9IiMmx4iI9/NV79DjbNz5iNESqmSAdCfP7D9aisoABPJM4cdvjKNyaOqaoLabZY3/AIkjvJtIpIVVRf6duYiWCwdnfI35pbnxBrZKJaS2w0Se9p87PG/SovyVt4tcPd9Sqv1cxJf0EHU8zQr5kZAtHG40eYnzTpNit0ORkLE3WYzvUbM8CdD7xS2bqhiwBAxkAkQVmAG1vk/vTLCDPJuAGgerAcf4n9KYwUqsgTjB8cHR/WnSYk2iRf64hiiqAAeGAYb2Y9p4+9De5mPpRQPQAEzzkfQAHVcH1ImdSTEwPQ0xkgBZAV5y40q/fzzQopaDs3sXBQ6KPobFxP3Ez+gIo1x3yBEAjJWH0mSSd+xMCaC95x3LrtHIB7QTj+u/5p/SJ2OSNiPPjtb9DQ9ZBfRynY70cjuYGGIAAymdR7VJvW1XJJLLOJEcAyVZY3B9qi/JUOzrMcDUcjf3NPtlcQ2DGDEqdQGHIHnnY96TBBrUQcu5F3qCVntiRsidev71cfh7o2u9QEVgoMvwCQCZOB5k4x4gxzVZec4YoRGmAVZ7QZBAE6MfUTwDXqX4I+D/AC7fzGxm4chjJ14knyBr9KjeAnLqjT9OkKB6UlOyrq2UaOSxl4VVfFenztspE6kfcVc3lqJcSnJWqBOnZ5D8XsFCDkdHsBggggyCSfSRAHp+sI6tsFOwDB9wQePH+lbr8S/BZBdFBI2J9PUfbmsOFVHwNzIsZHad4iCPYH1XUisIWsM77UlaArAT5lzIGcBvIqpac9+k/tFCvwXycyBiQRIyjtbGfBEU7qLKsuI4BLkn1GgpPnz94oPzVxGRjwPatEiZOsDusfMloiSACAABsYr9tfzSdPdKyVPJJjkAnmPQ0l4cGDCKfPvJJ/inlAPmXCe1CDiB9UgECfeT+1PCVCy8gykQsr+Zo3uTiQSdbprqtpwFBZgFkkgqdnICPaBPtTXcMFkCTJIE+TIBHH7UZEUozHlVlSSQAoO9csSdelKvYX6B3oZxnIU4xw5C736+vO/vTbvQsrmBlEEEedwO07n2pGvQ3AJxErztDI44HrT+mvkOXPdIYkTzOzHof8qKfgMeRx6tily2dAhtQB3nmTzPOqH1PUHdsytswVIED3IWIIPtXWuqx2EEzJJJZj+rTH3pvUXgxmIPkli+vTfFFOwtUOxtAqttiQ5BbKBiAPpkeDQncyCswigEjUfePcmj3cQoXTrMgq0MARwRA8x+1L0jgMACYIA+8DlvtzR9g/QJbNskf1AB/wDzjB+3la67ZgElwzk+OCPUnwfb2rksGYMD6Z8gBoj/ABFLmqGD4JDeQRsEjyDs0xD71xXUFzcZzAZmIeInannzwaf0ltCWT5mKkEyywMl2sd3JiJ+1R7Ikh5GAMEfmC+pAonSsFLhgCrKDl6CTx5BkDj0pME2F6rjMfnBH2mMv5BqPaAkZiRHHr6D96GXn1jcD0FK9wAevp/kKaVKiXK3YayAAbhgheB6seJ9hUd7hJTKCFgARGpnfrRLLFgUA2xBHtHvTGUTrYP7/AKijyF4DsZBXSwYmDwDoTumIsKqT5JJ55P1f96Nbsqo2CTrX1TkJAAjR8c0quwlbiqSASoCANH5obgEQPWam60XV7DN06uwReSJAJka0RBPqKTpumGJuQDwRIxOeXEkmNAz+lL0HT9jM4LuSAFiWUajERomRLcACtX+GPgz3bi3HhkQmIICT6MNyANe8Cs22sDtJWyd+E/w1m/zbihVIggay1sx6HZ3zNb5EVFCIoVVEADQAHoKZbAUYinqPAraEeqOTkm5sWa6pljoCRJrq0IJHWdL5FVjpWkqJ1HRhuNGgDMdX02YjyDI+9YP8UfBFR/nIkMecxkoIBjE+ASeB7TXpt/pmU7FRbloEEEAg8g8VEoXlbNePkcTwwO24xJjEW1KkBAdsMTKf51AVGNzExzvyOJYyPT/vXrHxr8JW3BayqqxBUrJAZSZgHeOxPFYPr/gTo5QowESSRLa0EQg70Od6I1Wd9Xk6U1NYKtW7pH0+AfI8x6j/ADotkY5sSSlsDfgnEYj3ImP+WiNb0wJUkLiqkNksejMAAxPJ9496Zd6XQRXzBxLLG+4aMead2OqEdBbIxJjTBiNrDalh6xQL1p+3GSS7oPMqz6Bn3pOpblWYL8tVEA5AmeOdxwYrr84BGIEtBM9sLLAgj3JmmvsT+hjqC/zFkGdeQ0wIEcnfHvT7Rtgatk8n6yAJ8AA7pOjtEJm7EookRMqcoMe8eff2prgbhi0byGzJP0wfMmKeNE52NwkzBCkxAMxAmB5481I6a2rMBgB9UAT/AHdAnzBE1yqIZSdgEca3yR5PpQnyTexEeCCJ4o2OqFS6q93OtyI2RB17URQsHYkjYGziOQT9I8U5uot/LbsCtEzJygxOiYPNCsqjgqilQIJdyNT/AHQBJmOB/wBqW0KqZGt3XUsSfq5/eZ/elS4yguCO4nZUEFvQGOYp9y6qhQGYjcFog+sKPv5pLbkMhCyCZG9b8edx+tP9E/sGyuSXIAk88b/ajEFgNfSO479dVIxIhLm1JC25JQjInJgsSSPeh2bTbJkroqTKBgfAaIH680dkPqwWHb+se2ooiWzsgLoSZk/UNAR58/pRFK4mF4P0llY7BUa9JiiZkD6YYHujjGR2kj6Tysn3ik5DUEJ09k/UBvDQnlj5AGyOaOYEMoVwfbjEd2OPcI9BNN+RcuXGbth4hTxhC4Y+eDoGPNWnw74Nca4Et2wSpBBVSAOQfmHYHngzWcmUlSK9FRpa2GU7E5sqk/Zh3b/aKm9B8GuX7820JC9sQCgWIlmJj1Mcn+a2/wAL/Btu33X3zP8Au0lEHPPlufYVobYW2oS2iog4CiBVqDZlPlSwsme+Efg63blr7fMdiJUE462AfXz7eK06KqgKgCqOABAH2AonTfD3fcH9auen+GKuzs1cYpaMJTlLZW9P0rNwP1q36bolXnZqSqgcU+rok6urq6mB1dSUtADGQHkVBv8Aw1TxqrGuoAzt/oXXxI9qrOs6K3dBW4vOvQ1taBc6VG5UUnFPY1JrR5V134LRvouE7JKuSwaeQTMx954rMfE/g120rBrbAnLuDRb7gAOAeAoAyIHPrXt934Qp4JFQrvwe54IP3rN8fo1jzyW8ngKdDEqUVVLA73s/lNw7xj3iTNTum6dT8xSlsPiQGAOMfVLFhEGAJ8mvV+v/AAytz67M+pUlf/id1R3/AMFWwCEzUH8rg3Lc+4JGh6TG6lxkbR5YHnbYXCyhTDdpNvYTCWWV4KxPvrVMv9OisiZsFVUMos5sFyLEzxLH7RWtufg28jSl60Blky/LKBmHEwToaoT/AIS6lmJa4rAgjteCAY0DjEc+J3z6zTQ/ki/JkXtlZUNvHscI2WRMbJBgRJJHMGmuqFZmQsMQrDtJ1ncOyxn8o2PPpWrX8J9Ta7LZhef9qGY6j6WQLFI34cvnm0ue8rn9JMlIIKlFaD6807Ydo+zJ2bAZSrYviCZUHOREBwQGxj2MxUjqrYbvG1gZIDojgMrGO3x7e1aFfgF9QR8gtJyJN5GMiQOeTHnVcn4YumQFeC2UHDz9QHdoEc80nYJx9lDZ6JCGe4qjErAHZkxWVQFjGzySYgUC4qkBiyqsuSFUH6sdKGgHXn7+9a9Pw11BMm6qSScVnU9ujGoAX9j61N6b8LXD9boxggsEYkzrcEA/rPmj8g7w9nn9tCFXJgqdrS6wSwLfSvLyCu+KkdLbbYFxTIIgghwCNFfDDiVEgfzXoHR/gRAQxR3O57MAZj08Vc2/wQjGTYUnW7hk6qusn4I+WKPMem6K4ThbQyAIZ5Jy/vRswNAT61pug/CDNBuEKuifLEge4/mJ969H6T8NFBClLY84j/6qfa+BWx9RLfxR8Te2S+f0jJdB8G6e39KSYAltyF4G5q4s9NcIC20hfYQK0dnorafSo/xNSIrSMEjGUnLZRWPgjHbtH22as+n+HonAk+pqZXVVEiAUtdXUwOpKHcuheTVP1vx5F7V2f4/U1LklsaTei6LAea6sm3VM2yx/QwP9aSs/mRp8TJXSfEHTXK+h/wCxq16X4rbc45AN/dOjWU6q+fpH6mh2ukDNzs7J/wDOaxXNKONm0uJPJvhS1lbXVvaUQxI9CZqw6P43kYZd+3FdEeRSwc8uNrJd11MR5p9aEHV1dXUAdTYFOrqABGyp5UftQm6G2eba/sKlV1AENvhlo/8Atr+1MPwq1/cH81PrqAIA+E2f92P5p4+HWv8AdrUyuoAjr0lscIv7CihAOAKfXUAJS11dQB1dXV1AHV1ITUe51QHg0rAkVxqj6r40VMBagXutuNy0D29xNRLlUS48blov+r+IW7alncKBskkAAe5NU3V/iMcIJ9+BVT1dpSDkMgQQQ2wQdEGfFUHw+Ua705Yt8nEqx2TauZYqxPLLiVnyADyTXPLnb0bx4Etmm6jqmfZaZ2PA/aoHUW5GvHB9Pb7f4UCxKypMjke3H+dSMtTWPZy2bKKWittfF12CSCCQYRm2NGR4P+OjS0/relV27pB9VMSNRNLTsKP/2Q==" class="img-fluid w-100 rounded-top" alt="">

                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                <?= $produto->categoriaProduto->nome ?? 'Sem Categoria' ?>
                            </div>
                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                <h4><?= $produto->nome ?></h4>
                                <p><?= $produto->descricao ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold mb-0"><?= Yii::$app->formatter->asCurrency($produto->preco, 'EUR') ?> / kg</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $count++;
                    if ($count % $productsPerRow == 0):
                        echo '</div>'; // Close the current row

                        $currentLine++;
                        if ($currentLine > $maxLines) {
                            break; // Stop after reaching the maximum lines
                        }
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

<script>
    var tabs = document.querySelectorAll("#produtoTabs a");

    tabs.forEach(function (tab) {
        tab.addEventListener("click", function (event) {
            // Remove the 'active' class from all navigation items
            tabs.forEach(function (tab) {
                tab.classList.remove("active");
            });

            // Add the 'active' class to the clicked navigation item
            event.currentTarget.classList.add("active");
        });
    });
</script>