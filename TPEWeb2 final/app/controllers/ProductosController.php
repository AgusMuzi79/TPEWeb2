<?php

    require_once './app/views/ProductosView.php';
    require_once './app/models/ProductosModel.php';
    require_once './app/helpers/AuthHelper.php';


    class ProductosController {
        private $model;
        private $view;
        private $authHelper;

        public function __construct() {
            $this->model = new ProductosModel();
            $this->view = new ProductosView();
            $this->authHelper = new AuthHelper();

        }

        public function showProductos() {
            $productos = $this->model->getProductos();
            $categorias = $this->model->getCategorias();
            if ($this->authHelper->esAdmin()) {
                $this->view->showProductosAdmin($productos, $categorias);
            } else {
                $this->view->showProductos($productos, $categorias);
            }
        }

        public function showCategoria($params) {
            $productos = $this->model->getCategoria($params);
            $categorias = $this->model->getCategorias();
            if ($this->authHelper->esAdmin()) {
                $this->view->showProductosAdmin($productos, $categorias);
            } else {
                $this->view->showProductos($productos, $categorias);
            }
        }

        public function showDetalle($params) {
            $detalle = $this->model->getDetalle($params);
            $this->view->showDetalle($detalle);
        }

        public function eliminarCategoria($categoria) {
            $this->model->eliminarCategoria($categoria);
            header("Location: " . BASE_URL . "productos");
        }

        public function crearCategoria() {
            $categoria = $_POST['categoria'];
            $this->model->crearCategoria($categoria);
            header("Location: " . BASE_URL . "productos");
        }

        public function editarCategoria() {
            $categoria = $_POST['categoria'];
            $categoriaNueva = $_POST['categoriaNueva'];
            $this->model->editarCategoria($categoria, $categoriaNueva);
            header("Location: " . BASE_URL . "productos");
        }

        public function agregarNuevoProducto() {
            $nombre = $_POST['nombre'];
            $id_categoria = $_POST['id_categoria'];
            $descripcion = $_POST['descripcion'];
            $this -> model -> agregarProducto($nombre, $descripcion, $id_categoria);
            header ("Location:" . BASE_URL. "productos");
        }
        public function eliminarProducto($id_producto) {
            $this -> model -> borrarProducto($id_producto);
            header ("Location:" . BASE_URL. "productos");
        }
        public function editarProducto() {
            $nombre = $_POST['productoNuevo'];
            $id_categoria = $_POST['categoriaNueva'];
            $descripcion = $_POST['descripcionNueva'];
            $id_producto = $_POST['id_producto'];
            //var_dump([$nombre, $descripcion, $id_categoria, $id_producto]);
            $this -> model -> cambiarProducto($nombre, $descripcion, $id_categoria, $id_producto);
            header ("Location:" . BASE_URL. "productos");
        }
    }

?>