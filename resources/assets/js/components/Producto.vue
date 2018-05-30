<template>
    <main class="app-content">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Productos
                        <button type="button" @click="abrirModal('producto','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarProducto(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarProducto(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Categoria</th>
                                    <th>Precio Venta</th>
                                    <th>Stock</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="producto in arrayProducto" :key="producto.id">
                                    <td>
                                        <button type="button" @click="abrirModal('producto','actualizar',producto)" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="producto.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarCategoria(producto.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarCategoria(producto.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="producto.codigo"></td>
                                    <td v-text="producto.nombre"></td>
                                    <td v-text="producto.nombre_categoria"></td>
                                    <td v-text="producto.precio_venta"></td>
                                    <td v-text="producto.stock"></td>
                                    <td v-text="producto.descripcion"></td>
                                    <td>
                                        <div v-if="producto.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pageNumber" :key="page" :class="[page == isActived ? 'active': '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                            
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Categoria</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idcategoria">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre"></option>
                                        </select>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Codigo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="codigo" class="form-control" placeholder="Codigo de Barras">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre Producto</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre Producto">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Precio Venta</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="precio_venta" class="form-control" placeholder="Nombre Producto">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">stock</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="stock" class="form-control" placeholder="Nombre Producto">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="descripcion" class="form-control" placeholder="Ingrese Descripcion">
                                    </div>
                                </div>

                                <div v-show="errorProducto" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMesjProducto" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarProducto()" >Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarProducto()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        data(){
            return{
                producto_id:0,
                idcategoria:0,
                nombre_categoria:'',
                codigo: '',
                nombre : '',
                precio_venta:0,
                stock:0,
                
                descripcion : '',

                // lista
                arrayProducto : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorProducto : 0,
                errorMostrarMesjProducto : [],
                // actualizar categoria
                
                //paginacion
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },

                offset : 3,
                criterio : 'nombre',
                buscar : '',
                arrayCategoria:[]
            }
        },

        computed: {
            isActived: function(){
                return this.pagination.current_page;

            },
            pageNumber: function(){
                if(!this.pagination.to){
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }

                return pagesArray;
            }
        },
        methods:{
            listarProducto(page,buscar,criterio){
                let me=this;
                var url='/producto?page=' + page + '&buscar=' + buscar + '&criterio='+criterio;
                axios.get(url).then(function(response) {
                    var respuesta = response.data;
                    me.arrayProducto = respuesta.productos.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error){

                    console.log(error);
                });
            },
            selectCategoria(){
                 let me=this;
                var url='/categoria/selectCategoria';
                axios.get(url).then(function(response) {
                   var respuesta = response.data;
                   me.arrayCategoria = respuesta.categorias;
                  
                   //console.log(response);
                })
                .catch(function (error){

                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                // actualiza pagina actual
                me.pagination.current_page = page;
                // envia la peticion para visualizar los datos
                me.listarProducto(page,buscar,criterio);
            },
            registrarProducto(){
                
                if(this.validarProducto()){
                    return;
                }
                let me = this;

                axios.post('/producto/registrar',{
                    'idcategoria':this.idcategoria,
                    'codigo':this.codigo,
                    'nombre' : this.nombre,
                    'stock': this.stock,
                    'precio_venta':this.precio_venta,
                    'descripcion' :this.descripcion
                }).then(function(response){
                    me.cerrarModal();
                    me.listarProducto(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarCategoria(){
                 if(this.validarCategoria()){
                    return;
                }
                let me = this;

                axios.put('/categoria/actualizar',{
                    'id' : this.categoria_id,
                    'nombre' : this.nombre,
                    'descripcion' :this.descripcion
                }).then(function(response){
                    me.cerrarModal();
                    me.listarCategoria(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                });
            },
            desactivarCategoria(id){
                swal({
                    title: '¿Estas Seguro de Desactivar?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'cancelar',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('/categoria/desactivar',{
                            'id': id
                        }).then(function(response){
                            me.listarCategoria(1,'','nombre');
                            swal(
                                'Desactivado!',
                                'El registro ha sido desactivado Correctamente.',
                                'success'
                                )
                        }).catch(function(error){
                            console.log(error);
                        });
                        
                        
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swal(
                        'Cancelado',
                        'Your imaginary file is safe :)',
                        'error'
                        )
                    }
                    })
            },
            activarCategoria(id){
                    swal({
                    title: '¿Estas Seguro de Activar la Categoria?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'cancelar',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('/categoria/activar',{
                            'id': id
                        }).then(function(response){
                            me.listarCategoria(1,'','nombre');
                            swal(
                                'Activado!',
                                'El registro ha sido Activado Correctamente.',
                                'success'
                                )
                        }).catch(function(error){
                            console.log(error);
                        });
                        
                        
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swal(
                        'Cancelado',
                        'Your imaginary file is safe :)',
                        'error'
                        )
                    }
                    })
            },
            validarProducto(){
                this.errorProducto=0;
                this.errorMostrarMesjProducto=[];
                if(this.idcategoria==0) this.errorMostrarMesjProducto.push("Seleccione una categoria");
                if(!this.stock) this.errorMostrarMesjProducto.push("El stock debe ser un numero y no debe estar vacio");
                if(!this.precio_venta) this.errorMostrarMesjProducto.push("El precio de venta debe ser un numero y no debe estar vacio");
                if(!this.nombre) this.errorMostrarMesjProducto.push("El nombre del producto no puede estar vacio");
                if(this.errorMostrarMesjProducto.length) this.errorProducto=1;
                return this.errorProducto;
            },
            abrirModal(modelo, accion,  data=[]){
                switch(modelo){
                    // verificamos si el modelo es el correspondiente
                case "producto":{

                    switch(accion){
                        case 'registrar':
                        {
                            this.modal  = 1;
                            this.tituloModal = 'Registrar Producto';
                            this.idcategoria = 0;
                            this.nombre_categoria='';
                            this.codigo='';
                            this.nombre = '';
                            this.precio_venta = 0;
                            this.stock = 0;
                            this.descripcion = '';
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar': 
                        {
                            //console.log(data);
                            this.modal=1;
                            this.tituloModal='Actualizar Producto';
                            this.tipoAccion=2;
                            this.nombre = data['nombre'];
                            this.descripcion = data['descripcion'];
                            this.producto_id = data['id'];
                            this.idcategoria= data['idcategoria'];
                            this.codigo=data['codigo'];
                            this.stock=data['stock'];
                            this.precio_venta=['precio_venta'];
                            break;
                        }
                    }
                }

                this.selectCategoria();

                }
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal='';
                this.idcategoria=0;
                this.nombre_categoria='';
                this.codigo='';
                this.nombre = '';
                this.precio_venta = 0;
                this.stock=0;
                this.descripcion='';
                this.errorProducto = 0;
            }
        },
        mounted() {
            //para el listado de una tabla
            this.listarProducto(1,this.buscar,this.criterio);
        }
    }
</script>

<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }

</style>
