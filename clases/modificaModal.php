<!-- Modal -->
<div class="modal fade" id="modificaModal" tabindex="-1" aria-labelledby="modificaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modificaModalLabel">Modificar Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="clases/actualiza.php" method="post">

                    <input type="hidden" id="id" name="id">

                    <div class="md-3">
                        <label for="inputEmail4" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="Nombre">
                    </div>
                    <div class="md-3">
                        <label for="validationDefaultUsername" class="form-label">Precio</label>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend2">$</span>
                            <input type="number" class="form-control" id="precio" name="Precio">
                        </div>
                    </div>
                    <div class="md-3">
                        <label for="inputAddress" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="descripcion" rows="3" name="Descripcion"></textarea>
                    </div>
                    <div class="md-3">
                        <label for="validationDefaultUsername" class="form-label">Descuento</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="descuento" name="Descuento">
                            <span class="input-group-text" id="inputGroupPrepend2">%</span>
                        </div>
                    </div>
                    <div class="md-3">
                        <label for="inputState" class="form-label">Categoria</label>
                        <select id="categoria" name="categoria" class="form-select">
                            <?php foreach ($categorias as $categoria) {
                                $_id = $categoria['id'];
                                $nombre = $categoria['nombre'];
                            ?>
                                <option value="<?php echo $_id ?>"><?php echo $nombre; ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="md-3">
                        <label for="inputState" class="form-label">Estado</label>
                        <select id="estado" name="estado" class="form-select">
                            <option value="">Selecionar...</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div><br>
                    <div class="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>