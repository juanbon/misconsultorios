	<div id="cabecera" class="grid_12" style="height:140px;">
		<div id="titulopag" style="line-height:160px;padding-left:20px;">
		<div id="titprin" style="cursor:pointer;float:left">MISCONSULTORIOS.COM </div>
		
	<?php
	
	if((isset($_SESSION['usuario'])) && (isset($_SESSION['id_usu'])) )
		{
		if(($_SESSION['usuario']=='admin') AND ($_SESSION['id_usu']=='1') )
		{
		?>
		<div   id="topdiv" style="margin-left:7px;width:205px;height:140px;float:left;display:none">
			
			<div style="position:relative;left:40px;top:25px;width:100px;height:30px;">
	
		</div>
		<div style="font-size:14px;color:red;position:relative;left:40px;clear:both;top:30px;width:100px;height:30px;">
		<input type="text" value="ADMINISTRADOR" disabled style="font-weight:bold;background-color:transparent;color:red;border:none">
		</div>
		
		
			<div style="position:relative;left:20px;top:40px;width:80px;height:30px;">
		<input  class="button small green" type="button"  title="Agregar mas consultorios" value="Agregar +" id="agregar">
		</div>
		
		
		<div style="float:left;position:relative;left:120px;top:10px;width:80px;height:30px;">
		<input  class="button small red" type="button" onclick="confirmacion();" title="Cerrar sesion Admin" value="Salir" id="agregar">
		</div>
		
		</div>
		
		<?php
		}
		}
		else
		{
		?>
		<div   id="topdiv" style="margin-left:7px;width:205px;height:140px;float:left;display:none">
		
		<div style="position:relative;left:40px;top:25px;width:100px;height:30px;">
		<input style="color:#EBEBEB" class="cajas" onblur="if(this.value==''){this.value='usuario';}" onclick="if(this.value=='usuario'){this.value='';}" type="text" value="usuario" id="user">
		</div>
		
	
		<div style="position:relative;left:40px;clear:both;top:30px;width:100px;height:30px;">
		<input style="color:#EBEBEB"  class="cajas" type="password"  id="pass">
		</div>
		
		
			<div style="position:relative;left:40px;clear:both;top:40px;width:100px;height:30px;">
		<input  class="button small green" type="button" value="Entrar" id="entrar">
		</div>
		
		</div>
		<?php
		
		}
		?>
		</div>
		
	</div>