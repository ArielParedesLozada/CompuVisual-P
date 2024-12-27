<?php
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Estudiantes</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --danger: #dc2626;
            --danger-hover: #b91c1c;
            --success: #16a34a;
            --success-hover: #15803d;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title {
            font-size: 1.875rem;
            font-weight: bold;
            color: #1e293b;
            margin: 0;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.375rem;
            margin: 1rem 0;
        }

        .alert-success {
            background-color: #dcfce7;
            color: var(--success);
            border: 1px solid #bbf7d0;
        }

        .alert-warning {
            background-color: #fff7ed;
            color: #c2410c;
            border: 1px solid #fed7aa;
        }

        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1.5rem;
        }

        /* Personalización de EasyUI */
        .easyui-datagrid {
            border-radius: 0.375rem !important;
            overflow: hidden;
        }

        .datagrid-header {
            background: #f8fafc !important;
        }

        .datagrid-row-selected {
            background: #e0e7ff !important;
        }

        .easyui-linkbutton {
            border-radius: 0.375rem !important;
            padding: 0.5rem 1rem !important;
            height: auto !important;
            line-height: 1.5 !important;
            margin-right: 0.5rem;
            transition: all 0.2s;
        }

        .action-primary {
            background-color: var(--primary) !important;
            color: white !important;
            border: none !important;
        }

        .action-primary:hover {
            background-color: var(--primary-hover) !important;
        }

        .action-danger {
            background-color: var(--danger) !important;
            color: white !important;
            border: none !important;
        }

        .action-danger:hover {
            background-color: var(--danger-hover) !important;
        }

        .dialog-button {
            background-color: #f8fafc !important;
            padding: 1rem !important;
            border-top: 1px solid #e2e8f0 !important;
        }

        .dialog-button a.easyui-linkbutton {
            margin-left: 0.5rem;
        }

        #fm {
            padding: 2rem !important;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .textbox {
            border-radius: 0.375rem !important;
            padding: 0.5rem !important;
            height: auto !important;
        }

        .textbox-focused {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2) !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <h2 class="title">Sistema de Gestión de Estudiantes</h2>
                <?php if ($loggedIn): ?>
                    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="cerrarSesion()">
                        Cerrar Sesión
                    </a>
                <?php else: ?>
                    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="iniciarSesion()">
                        Iniciar Sesión
                    </a>
                <?php endif; ?>
            </div>
            <?php if ($loggedIn): ?>
                <div class="alert alert-success">
                    Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    Debe iniciar sesión para poder agregar, editar o eliminar estudiantes.
                </div>
            <?php endif; ?>
        </div>

        <div class="card">
            <table id="dg" title="Estudiantes" class="easyui-datagrid" 
                url="./Models/getstudents.php"
                toolbar="#toolbar" 
                pagination="true"
                rownumbers="true" 
                fitColumns="true" 
                singleSelect="true"
                style="width:100%;height:400px">
                <thead>
                    <tr>
                        <th field="0" width="15%">Cédula</th>
                        <th field="1" width="20%">Nombre</th>
                        <th field="2" width="20%">Apellido</th>
                        <th field="3" width="20%">Teléfono</th>
                        <th field="4" width="25%">Dirección</th>
                    </tr>
                </thead>
            </table>

            <div id="toolbar" style="padding:0.5rem;">
                <?php if ($loggedIn): ?>
                    <a href="javascript:void(0)" class="easyui-linkbutton " iconCls="icon-add" onclick="newUser()">
                        Nuevo estudiante
                    </a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="editUser()">
                        Editar estudiante
                    </a>
                    <a href="javascript:void(0)" class="easyui-linkbutton " iconCls="icon-remove" onclick="destroyUser()">
                        Eliminar estudiante
                    </a>
                <?php endif; ?>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="FPDFreport()">
                    Reporte PDF
                </a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="JasperReport()">
                    Reporte JasperReport
                </a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="singleReport()">
                    Reporte del usuario
                </a>
            </div>

            <div id="dlg" class="easyui-dialog" style="width:500px" 
                data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
                <form id="fm" method="post" novalidate>
                    <h3 style="margin-top:0">Información del estudiante</h3>
                    <div class="form-group">
                        <input name="cedula" class="easyui-textbox" required="true" label="Cédula:" style="width:100%">
                    </div>
                    <div class="form-group">
                        <input name="nombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
                    </div>
                    <div class="form-group">
                        <input name="apellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%">
                    </div>
                    <div class="form-group">
                        <input name="telefono" class="easyui-textbox" required="true" label="Teléfono:" style="width:100%">
                    </div>
                    <div class="form-group">
                        <input name="direccion" class="easyui-textbox" required="true" label="Dirección:" style="width:100%">
                    </div>
                </form>
            </div>
            
            <div id="dlg-buttons">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">
                    Guardar
                </a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">
                    Cancelar
                </a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Mantener el mismo JavaScript que tenías, solo actualizar los mensajes para mejor UX
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
                $.messager.alert('Aviso', 'Por favor selecciona un estudiante para generar el reporte.', 'info');
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
            } else {
                $.messager.alert('Aviso', 'Por favor selecciona un estudiante para editar.', 'info');
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
                    try {
                        var result = JSON.parse(result);
                        if (!result.success) {
                            $.messager.show({
                                title: 'Error',
                                msg: result.error,
                                timeout: 5000,
                                showType: 'slide'
                            });
                        } else {
                            $('#dlg').dialog('close');
                            $('#dg').datagrid('reload');
                            $.messager.show({
                                title: 'Éxito',
                                msg: 'Operación completada correctamente.',
                                timeout: 5000,
                                showType: 'slide'
                            });
                        }
                    } catch (e) {
                        $.messager.alert('Error', 'Ha ocurrido un error en el servidor.', 'error');
                    }
                }
            });
        }

        function destroyUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', '¿Está seguro que desea eliminar este estudiante?', function(r) {
                    if (r) {
                        const id = row[0];
                        $.post('./Models/deletestudent.php', {
                            cedula: id
                        }, function(result) {
                            if (result.success) {
                                $('#dg').datagrid('reload');
                                $.messager.show({
                                    title: 'Éxito',
                                    msg: 'Estudiante eliminado correctamente.',
                                    timeout: 5000,
                                    showType: 'slide'
                                });
                            } else {
                                $.messager.show({
                                    title: 'Error',
                                    msg: result.error || 'Error al eliminar el estudiante.',
                                    timeout: 5000,
                                    showType: 'slide'
                                });
                            }
                        }, 'json');
                    }
                });
            } else {
                $.messager.alert('Aviso', 'Por favor selecciona un estudiante para eliminar.', 'info');
            }
        }
    </script>
</body>
</html>