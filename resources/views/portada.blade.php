@extends('layouts.welcome')

@section('content')

<div class="row mr-0">
    <div class="col-lg-12 pr-0">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100 " src="images/portada.jpg" alt="Tu Vecindad">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/villa.png" alt="Tu Vecindad">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/piscina.jpg" alt="Tu Vecindad">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/fachada.jpg" alt="Tu Vecindad">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/parque.jpg" alt="Tu Vecindad">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/img1.jpg" alt="Tu Vecindad">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/gimnasio.jpg" alt="Tu Vecindad">
          </div>
                 </div>

    </div>


        <h4 class="carousel-caption texto ">Gestiona tu comunidad tranquilamente desde cualquier dispositivo móvil, tablet o pc </h4>

</div>


<div class="row m-4 p-4 d-flex flex-lg-nowrap justify-content-lg-around">
    <div class="col xs-col-1 sm-col-6 md-col-6 lg-col-3 ">
        <div class="card m-3 p-3 zoom " style="width: 16rem;">

            <i style='font-size:80px' class='fas text-center m-2'>&#xf64f;</i>
                <div class="card-body">
                    <h5 class="card-title">Alta de comunidad</h5>
                    <p class="card-text">Cree la ficha de la comunidad y propiedades de cada usuario</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Regístrese</li>
                    <li class="list-group-item">Cumplimente el formulario</li>
                     <li class="list-group-item">Asigne propiedades</li>
                </ul>
        </div>
    </div>

    <div class="col xs-col-1 sm-col-6 md-col-6 lg-col-3 ">
        <div class="card m-3 p-3 zoom " style="width: 16rem;">

            <i style='font-size:80px' class='fas text-center m-2'>&#xf0c0;</i>

            <div class="card-body">
                <h5 class="card-title">Alta de propietarios</h5>
                <p class="card-text">Asocie los propietarios a cada una de las propiedades</p>
            </div>
            <ul class="list-group list-group-flush">
             <li class="list-group-item">Identifique su comunidad</li>
            <li class="list-group-item">Añada las propiedades</li>
            <li class="list-group-item">Asigne los usuarios</li>
             </ul>
     </div>
    </div>

      <div class="col xs-col-1 sm-col-6 md-col-6 lg-col-3 ">
            <div class="card m-3 p-3 zoom " style="width: 16rem;">

                <i style='font-size:80px' class='fas text-center m-2'>&#xf1fe;</i>
                <div class="card-body">
                    <h5 class="card-title">Gestiona gastos</h5>
                    <p class="card-text">Reparta las cuotas de propietarios mediante domiciliación bancaria</p>
                </div>
                <ul class="list-group list-group-flush">
                     <li class="list-group-item">Identifique Comunidad</li>
                     <li class="list-group-item">Seleccione propiedad</li>
                    <li class="list-group-item">Asigne la cuota</li>
                </ul>
            </div>
        </div>


      <div class="col xs-col-1 sm-col-6 md-col-6 lg-col-3 ">
            <div class=" card m-3 p-3 zoom " style="width: 16rem;">

                <i style='font-size:80px' class='fas text-center m-2'>&#xf044;</i>
                <div class="card-body">
                     <h5 class="card-title">Foro</h5>
                     <p class="card-text">Boletín actualizado de programación de Juntas e incidencias</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Identifique comunidad</li>
                     <li class="list-group-item">Acceda al foro de noticias</li>
                    <li class="list-group-item">Deje su mensaje</li>
                </ul>
            </div>
        </div>
</div>




@endsection
