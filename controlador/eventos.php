<table id="dg" title="Lista de Usuarios" class="easyui-datagrid" style="width:100%;height:auto; margin:10px;"
            url="controlador/usuario.php?op=select"
            toolbar="#toolbar" pagination="false" 
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>               
                <th field="login" width="100">LOGIN</th>
                <th field="nombre" width="100">NOMBRE</th>
            </tr>
        </thead>
    </table>
      
     
    </div>
    <div id="toolbar">      
        <input class="easyui-searchbox" data-options="prompt:'Buscar' " style="width:250px">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="refrescar()">Refrescar</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="frmUSuario" method="post"     style="margin:0;padding:20px 50px">
            <h3>User Information</h3>
            <div style="margin-bottom:10px">
                <input name="login" class="easyui-textbox" required="true" label="First Name:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Last Name:" style="width:100%">
            </div> 
             
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" id='btnSave' class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>
    
    <script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Ingresar Usuario');
            $('#frmUSuario').form('clear');
            url = 'controlador/usuario.php?op=insert';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
                $('#frmUSuario').form('load',row);
                url = 'controlador/usuario.php?op=edit&&id='+row.id;
            }
        }
        function saveUser(){
                  $.messager.progress({
                       title:'Por favor espere',
                      msg:'Cargando datos...'
                      });
           $('#frmUSuario').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                   
                    $.messager.progress('close');
                    var result = eval('('+result+')');
                    console.log(result);
                  
                    if (result.errorMsg){ 
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {                    
                      
                        $('#dlg').dialog('close');      
                        $('#dg').datagrid('reload');   
                    }
                }
            }); 
        }
        
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','¿Estás seguro de Eliminar el item seleccionado?',function(r){
                    if (r){
                        $.post('controlador/usuario.php?op=delete',{id:row.id},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    
                            } else {
                                $.messager.show({    
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
        function refrescar(){
            $('#dg').datagrid('reload');   
        }
    </script>   