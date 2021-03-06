<?php
/**
 *@package pXP
 *@file    ReporteCuentaDoc.php
 *@author  Gonzalo Sarmiento Sejas
 *@date    04-11-2016
 *@description Reporte Cuenta Doc
 */
header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.ReporteCuentaDoc = Ext.extend(Phx.frmInterfaz, {
        Atributos : [
            {
                config:{
                    name:'id_funcionario',
                    hiddenName: 'Solicitante',
                    origen:'FUNCIONARIO',
                    fieldLabel:'Funcionario',
                    allowBlank:false,
                    width:200,
                    valueField: 'id_funcionario',
                    gdisplayField: 'desc_funcionario',
                    baseParams: { todos : 'si', fecha:new Date() }
                },
                type:'ComboRec',//ComboRec
				id_grupo:0,
                form:true
            },
            {
                config:{
                    name: 'fecha_ini',
                    fieldLabel: 'Fecha Inicio',
                    allowBlank: false,
                    disabled: false,
                    width:200,
                    format: 'd/m/Y'

                },
                type:'DateField',
                id_grupo:0,
                form:true
            },
            {
                config:{
                    name: 'fecha_fin',
                    fieldLabel: 'Fecha Fin',
                    allowBlank: false,
                    disabled: false,
                    width:200,
                    format: 'd/m/Y'

                },
                type:'DateField',
                id_grupo:0,
                form:true
            },
            {
				config:{
					name:'codigo_tipo_cuenta_doc',
					fieldLabel:'Tipo Fondo Avance',
					allowBlank:false,
					emptyText:'Tipo...',
					typeAhead: true,
					triggerAction: 'all',
					lazyRender:true,
					mode: 'local',
					valueField: 'estilo',
					store: new Ext.data.JsonStore({
						url: '../../sis_cuenta_documentada/control/TipoCuentaDoc/listarTipoCuentaDoc',
						id: 'codigo',
						root: 'datos',
						sortInfo:{
							field: 'nombre',
							direction: 'ASC'
						},
						totalProperty: 'total',
						fields: ['id_tipo_cuenta_doc','nombre','codigo','descripcion'],
						// turn on remote sorting
						remoteSort: true,
						baseParams:{par_filtro:'nombre', sw_solicitud: 'si'}
					}),
					enableMultiSelect:true,   
					valueField: 'codigo',
					displayField: 'nombre',
					hiddenName: 'codigo',
					forceSelection:true,
					typeAhead: false,
					triggerAction: 'all',
					lazyRender:true,
					mode:'remote',
					width:200,
					pageSize:10,
					queryDelay:1000,
					listWidth:300,
					resizable:true
				},
				type : 'AwesomeCombo',
				id_grupo:1,
				form:true
			},
			{
			config : {
						name:'estado',
						qtip:'todos los pagos que esten en alguno de los estados seleccionados',
						fieldLabel : 'En estado:',
						resizable:true,
						allowBlank:true,
		   				emptyText:'Seleccione un catálogo...',
		   				store: new Ext.data.JsonStore({
							url: '../../sis_parametros/control/Catalogo/listarCatalogoCombo',
							id: 'id_catalogo',
							root: 'datos',
							sortInfo:{
								field: 'orden',
								direction: 'ASC'
							},
							totalProperty: 'total',
							fields: ['id_catalogo','codigo','descripcion'],
							// turn on remote sorting
							remoteSort: true,
							baseParams: {par_filtro:'descripcion',cod_subsistema:'CD',catalogo_tipo:'tcuenta_doc'}
						}),
	       			    enableMultiSelect:true,    				
						valueField: 'codigo',
		   				displayField: 'descripcion',
		   				gdisplayField: 'catalogo',
		   				forceSelection:true,
		   				typeAhead: false,
		       			triggerAction: 'all',
		       			lazyRender:true,
		   				mode:'remote',
		   				pageSize:10,
		   				queryDelay:1000,
		   				width:200,
		   				minChars:2
		    },
			type : 'AwesomeCombo',
			form : true
		 },
		 {
			config : {
						name:'fuera_estado',
						qtip:'todos los pagos que NO esten en alguno de los estados seleccionados',
						fieldLabel : 'No estado:',
						resizable:true,
						allowBlank:true,
		   				emptyText:'Seleccione un catálogo...',
		   				store: new Ext.data.JsonStore({
							url:'../../sis_parametros/control/Catalogo/listarCatalogoCombo',
							id: 'id_catalogo',
							root: 'datos',
							sortInfo:{
								field: 'orden',
								direction: 'ASC'
							},
							totalProperty: 'total',
							fields: ['id_catalogo','codigo','descripcion'],
							// turn on remote sorting
							remoteSort: true,
							baseParams: {par_filtro:'descripcion',cod_subsistema:'CD',catalogo_tipo:'tcuenta_doc'}
						}),
	       			    enableMultiSelect:true,    				
						valueField: 'codigo',
		   				displayField: 'descripcion',
		   				gdisplayField: 'catalogo',
		   				hiddenName: 'catalogo',
		   				forceSelection:true,
		   				typeAhead: false,
		       			triggerAction: 'all',
		       			lazyRender:true,
		   				mode:'remote',
		   				pageSize:10,
		   				queryDelay:1000,
		   				width:200,
		   				minChars:2
		    },
			type : 'AwesomeCombo',
			form : true
		}
        ],
        title : 'Generar Reporte',
        ActSave : '../../sis_cuenta_documentada/control/CuentaDoc/listarReporteCuentaDoc',
        topBar : true,
        botones : false,
        labelSubmit : 'Imprimir',
        tooltipSubmit : '<b>Generar Reporte</b>',
        constructor : function(config) {
            Phx.vista.ReporteCuentaDoc.superclass.constructor.call(this, config);
            this.init();
        },
        tipo : 'reporte',
        clsSubmit : 'bprint'
    })
</script>