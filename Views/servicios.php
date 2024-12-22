<?php
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
</head>

<body>
    <h2>Manejo de estudiantes</h2>
    <?php if ($loggedIn): ?>
        <div class="alert alert-success">
            Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            Debe iniciar sesión para poder agregar, editar o eliminar estudiantes.
        </div>
    <?php endif; ?>
    <table id="dg" title="My Users" class="easyui-datagrid" style="width:700px;height:250px"
        url="./Models/getstudents.php"
        toolbar="#toolbar" pagination="true"
        rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="0" width="50">Cedula</th>
                <th field="1" width="50">Nombre</th>
                <th field="2" width="50">Apellido</th>
                <th field="3" width="50">Telefono</th>
                <th field="4" width="50">Direccion</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <?php if ($loggedIn): ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo estudiante</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar estudiante</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar estudiante</a>
        <?php endif; ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="FPDFreport()">Reporte PDF</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="JasperReport()">Reporte JasperReport</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="singleReport()">Reporte del usuario</a>
    </div>

    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Información del estudiante</h3>
            <div style="margin-bottom:10px">
                <input name="cedula" class="easyui-textbox" required="true" label="Cedula:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="apellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="telefono" class="easyui-textbox" required="true" label="Telefono:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="direccion" class="easyui-textbox" required="true" label="Direccion:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <br>
    <br>
    <div>
        <?php if ($loggedIn): ?>
            <button class="easyui-linkbutton" onclick="cerrarSesion()">Cerrar Sesión</button>
        <?php else: ?>
            <button class="easyui-linkbutton" onclick="iniciarSesion()">Iniciar Sesión</button>
        <?php endif; ?>
    </div>
    <script type="text/javascript">
        var url;

        function iniciarSesion() {
            window.location.href = './views/login.php';
        }

        function cerrarSesion() {
            window.location.href = './Controllers/logout.php';
        }

        function FPDFreport() {
            window.open('./Reports/FPDF.php', '_blank')
        }

        function JasperReport() {
            window.open('./Reports/JasperReport.php', '_blank');
        }

        function singleReport() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                window.open('./Reports/singleReport.php?id=' + row[0], '_blank')
            } else {
                $.messager.alert('Advertencia', 'Por favor selecciona un estudiante para generar el reporte.', 'warning');
            }
        }

        function newUser() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo estudiante');
            $('#fm').form('clear');
            url = './Models/newstudent.php';
        }

        function editUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar estudiante');
                let rowMapped = {
                    cedula: row[0],
                    nombre: row[1],
                    apellido: row[2],
                    telefono: row[3],
                    direccion: row[4]
                };

                $('#fm').form('load', rowMapped);
                url = './Models/editstudent.php?id=' + row[0];
            }
        }

        function saveUser() {
            $('#fm').form('submit', {
                url: url,
                iframe: false,
                onSubmit: function() {
                    return $(this).form('validate');
                },
                success: function(result) {
                    console.log(result)
                    try {
                        var result = JSON.parse(result);
                        if (!result.success) {
                            $.messager.show({
                                title: 'Error',
                                msg: result.error
                            });
                        } else {
                            $('#dlg').dialog('close');
                            $('#dg').datagrid('reload');
                        }
                    } catch (e) {
                        $.messager.alert('Error', e, 'error');
                    }
                }
            });
        }

        function destroyUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', '¿Quiere eliminar al estudiante?', function(r) {
                    if (r) {
                        const id = row[0]
                        console.log(id)
                        $.post('./Models/deletestudent.php', {
                            cedula: id
                        }, function(result) {
                            if (result.success) {
                                $('#dg').datagrid('reload'); // reload the user data
                            } else {
                                $.messager.show({ // show error message
                                    title: 'Error',
                                    msg: result.error
                                });
                            }
                        }, 'json');
                    }
                });
            }
        }
    </script>
</body>

</html>