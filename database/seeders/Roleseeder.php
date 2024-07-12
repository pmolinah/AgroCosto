<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\comuna;
use App\Models\tipo;
use App\Models\tipousuario;
use App\Models\variedad;
use App\Models\especie;
use App\Models\color;
use App\Models\observacion;
use Illuminate\Support\Facades\Hash;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        color::create(['color'=>'AZUL']);
        color::create(['color'=>'AMARILLO']);
        color::create(['color'=>'ROJO']);
        color::create(['color'=>'GRIS']);

        observacion::create(['observacion'=>'Vacio']);
        observacion::create(['observacion'=>'PreCalibre']);
        observacion::create(['observacion'=>'Nacional']);
        observacion::create(['observacion'=>'Sobras']);
       
        $role1= Role::create(['name'=>'Admin','description'=>'Rol con todas los permiso del sistema, Administrador de Sistema']);
          
                // Permisos de Sistema
                //usuario
                Permission::create(['name'=>'adm.ver.usuarios','description'=>'Ver Lista de Usuarios'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.crear.usuarios','description'=>'Crear Usuarios'])->assignRole([$role1]); //ok
                Permission::create(['name'=>'adm.editar.usuarios','description'=>'Editar, Actualizar Usuarios'])->assignRole([$role1]);
                // Permission::create(['name'=>'adm.eliminar.usuarios','description'=>'Eliminar, Dehabilitar Usuarios']);
                //roles
                Permission::create(['name'=>'adm.ver.roles','description'=>'Ver Lista de Roles'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.crear.roles','description'=>'Crear Roles'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.editar.roles','description'=>'Editar, Actualizar Roles'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.eliminar.roles','description'=>'Eliminar Roles'])->assignRole([$role1]);
                //empresas
                Permission::create(['name'=>'adm.ver.empresas','description'=>'Ver Lista de Empresas'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.crear.empresas','description'=>'Crear Empresas'])->assignRole([$role1]); 
                Permission::create(['name'=>'adm.editar.empresas','description'=>'Editar, Actualizar Empresas'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.eliminar.empresas','description'=>'Eliminar Empresas'])->assignRole([$role1]); 
                //Campos
                Permission::create(['name'=>'adm.ver.campos','description'=>'Ver Lista de Campos'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.crear.campos','description'=>'Crear Campos'])->assignRole([$role1]); 
                Permission::create(['name'=>'adm.editar.campos','description'=>'Editar, Actualizar Campos'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.eliminar.campos','description'=>'Eliminar Campos'])->assignRole([$role1]); 
                //Cuarteles
                Permission::create(['name'=>'adm.ver.cuarteles','description'=>'Ver Lista de Cuarteles'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.crear.cuarteles','description'=>'Crear Cuarteles'])->assignRole([$role1]); 
                Permission::create(['name'=>'adm.editar.cuarteles','description'=>'Editar, Actualizar Cuarteles'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.eliminar.cuarteles','description'=>'Eliminar Cuarteles'])->assignRole([$role1]);
                //Configiración //variedades
                Permission::create(['name'=>'adm.ver.variedades','description'=>'Ver Lista de Variedades'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.crear.variedades','description'=>'Crear Variedades'])->assignRole([$role1]); 
                Permission::create(['name'=>'adm.editar.variedades','description'=>'Editar, Actualizar Variedades'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.eliminar.variedades','description'=>'Eliminar Variedades'])->assignRole([$role1]);
                //Configiración //especies
                Permission::create(['name'=>'adm.ver.especies','description'=>'Ver Lista de Especies'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.crear.especies','description'=>'Crear Especies'])->assignRole([$role1]); 
                Permission::create(['name'=>'adm.editar.especies','description'=>'Editar, Actualizar Especies'])->assignRole([$role1]);
                Permission::create(['name'=>'adm.eliminar.especies','description'=>'Eliminar Especies'])->assignRole([$role1]); 
                 //Configiración //envases
                 Permission::create(['name'=>'adm.ver.envases','description'=>'Ver Lista de Envases'])->assignRole([$role1]);
                 Permission::create(['name'=>'adm.crear.envases','description'=>'Crear Envases'])->assignRole([$role1]); 
                 Permission::create(['name'=>'adm.editar.envases','description'=>'Editar, Actualizar Envases'])->assignRole([$role1]);
                 Permission::create(['name'=>'adm.eliminar.envases','description'=>'Eliminar Envases'])->assignRole([$role1]); 
                 //Cuenta corriente envases
                 Permission::create(['name'=>'adm.ver.cuentacorriente','description'=>'Ver Lista de Cuenta Corriente Envases'])->assignRole([$role1]);
                 Permission::create(['name'=>'adm.crear.cuentacorriente','description'=>'Crear Cuenta Corriente Envases'])->assignRole([$role1]); 
                 Permission::create(['name'=>'adm.editar.cuentacorriente','description'=>'Editar, Actualizar Cuenta Corriente Envases'])->assignRole([$role1]);
                 Permission::create(['name'=>'adm.eliminar.cuentacorriente','description'=>'Eliminar Cuenta Corriente Envases']); 
                 //plantacion
                 Permission::create(['name'=>'adm.ver.plantacion','description'=>'Ver Lista Plantacion'])->assignRole([$role1]); //ok
                 Permission::create(['name'=>'adm.crear.plantacion','description'=>'Crear Plantacion'])->assignRole([$role1]); //ok
                //  Permission::create(['name'=>'adm.editar.plantacion','description'=>'Editar, Actualizar Plantacion']);
                 Permission::create(['name'=>'adm.eliminar.plantacion','description'=>'Eliminar Plantacion'])->assignRole([$role1]);  //ok
                 //planificacion
                 Permission::create(['name'=>'adm.ver.planificacion','description'=>'Ver Lista Planificacion'])->assignRole([$role1]);                //ok
                 Permission::create(['name'=>'adm.crear.planificacion','description'=>'Crear Planificacion'])->assignRole([$role1]);                  //ok
                 Permission::create(['name'=>'adm.editar.planificacion','description'=>'Editar, Actualizar Planificacion'])->assignRole([$role1]);    //ok
                 Permission::create(['name'=>'adm.eliminar.planificacion','description'=>'Eliminar Planificacion'])->assignRole([$role1]);            //ok 
                 //cosechar
                 Permission::create(['name'=>'adm.ver.cosechar','description'=>'Ver Lista Cosechas Asignadas'])->assignRole([$role1]);    //ok
                 Permission::create(['name'=>'adm.crear.cosechar','description'=>'Permiso de Cosechar'])->assignRole([$role1]);   //ok
                //  Permission::create(['name'=>'adm.editar.cosechar','description'=>'Editar, Actualizar Cosechas']);  //ok
                //  Permission::create(['name'=>'adm.eliminar.cosechar','description'=>'Eliminar Cosechas']);
                 Permission::create(['name'=>'adm.ver.cosechas.finalizadas','description'=>'Ver Lista Cosechas Finalizadas'])->assignRole([$role1]);
                 //Certificación
                 Permission::create(['name'=>'adm.ver.certificados','description'=>'Ver Lista Certificación'])->assignRole([$role1]);
                 Permission::create(['name'=>'adm.crear.certificados','description'=>'Crear Certificación'])->assignRole([$role1]); 
                 Permission::create(['name'=>'adm.editar.certificados','description'=>'Editar, Actualizar Certificación'])->assignRole([$role1]);
                 Permission::create(['name'=>'adm.eliminar.certificados','description'=>'Eliminar Certificación'])->assignRole([$role1]);
                  //Producción
                //   Permission::create(['name'=>'prod.ver.despacho','description'=>'Ver Lista Despacho']);
                 Permission::create(['name'=>'prod.crear.despacho','description'=>'Crear Despacho'])->assignRole([$role1]); 
                //   Permission::create(['name'=>'prod.editar.despacho','description'=>'Editar, Actualizar Despacho']);
                //   Permission::create(['name'=>'prod.eliminar.despacho','description'=>'Eliminar Despacho']);
                  //recepcion
                //   Permission::create(['name'=>'prod.ver.recepcion','description'=>'Ver Lista Recepción']);
                  Permission::create(['name'=>'prod.crear.recepcion','description'=>'Crear Recepción'])->assignRole([$role1]); 
                //   Permission::create(['name'=>'prod.editar.recepcion','description'=>'Editar, Actualizar Recepción']);
                //   Permission::create(['name'=>'prod.eliminar.recepcion','description'=>'Eliminar Recepción']);
                  //recepcion
                //   Permission::create(['name'=>'prod.ver.devtras','description'=>'Ver Lista Devolución o Traspaso']);
                  Permission::create(['name'=>'prod.crear.devtras','description'=>'Crear Devolución o Traspaso'])->assignRole([$role1]); 
                //   Permission::create(['name'=>'prod.editar.devtras','description'=>'Editar, Actualizar Devolución o Traspaso']);
                //   Permission::create(['name'=>'prod.eliminar.devtras','description'=>'Eliminar Devolución o Traspaso']);
                   Permission::create(['name'=>'prod.guias.finalizadas','description'=>'Ver Guías Finalizadas'])->assignRole([$role1]);
                //Planificacion estimada
                Permission::create(['name'=>'prod.plan.estimada.ver','description'=>'Ver Planificaciones Estimadas'])->assignRole([$role1]);
                Permission::create(['name'=>'prod.plan.estimada.crear','description'=>'Crear Planificaciones Estimadas'])->assignRole([$role1]);
                   //botones
                Permission::create(['name'=>'prod.menu.btn','description'=>'Boton para Acceder a Opciones Produccion'])->assignRole([$role1]);
                Permission::create(['name'=>'Adm.menu.btn','description'=>'Boton para Acceder a Opciones Roles'])->assignRole([$role1])->assignRole([$role1]);
                Permission::create(['name'=>'Adm.emp.btn','description'=>'Boton para Acceder a Opciones Empresas'])->assignRole([$role1]);
                Permission::create(['name'=>'Adm.plan.est.btn','description'=>'Boton para Acceder a Opciones Estimaciones'])->assignRole([$role1]);

        $tipousuario=tipousuario::create([
            'tipousuario'=>'Administrador',
        ]);
        $tipousuario=tipousuario::create([
            'tipousuario'=>'Capataz',
        ]);
        $tipousuario=tipousuario::create([
            'tipousuario'=>'Supervisor',
        ]);
        $tipousuario=tipousuario::create([
            'tipousuario'=>'Cliente',
        ]);
        $tipousuario=tipousuario::create([
            'tipousuario'=>'Encargado de Bodega',
        ]);
        $tipousuario=tipousuario::create([
            'tipousuario'=>'Conductor',
        ]);




        $user = User::create([
            'name'=>'Administrador',
            'email'=>'p@p.cl',
            'password'=>bcrypt('11111111'),
            'tipo_id'=>1,
        ])->assignRole($role1);


        Tipo::create(['tipo'=>'Campo']);
        Tipo::create(['tipo'=>'Proveedor']);
        Tipo::create(['tipo'=>'Contratista']);
        Tipo::create(['tipo'=>'Exportadora']);
        Tipo::create(['tipo'=>'Transportista']);

        // comunas de Chile
        $comuna1=['Algarrobo (Provincia San Antonio, V Región de Valparaíso)','Alhué (Provincia Melipilla, Región Metropolitana de Santiago)','Alto Bío Bío (Provincia Bío Bío, VIII Región del Biobío)','Alto del Carmen (Provincia Huasco, III Región de Atacama)','Alto Hospicio (Provincia Iquique, I Región de Tarapacá)','Ancud (Provincia Chiloé, X Región de Los Lagos)','Andacollo (Provincia Elqui, IV Región de Coquimbo)','Angol (Provincia Malleco, IX Región de la Araucanía)','Antártica (Provincia Antártica Chilena, XII Región de Magallanes y de la Antártica Chilena)','Antofagasta (Provincia Antofagasta, II Región de Antofagasta)','Antuco (Provincia Bío Bío, VIII Región del Biobío)','Arauco (Provincia Arauco, VIII Región del Biobío)','Arica (Provincia Arica, XV Región de Arica y Parinacota)','Aysén (Provincia Aysén, XI Región Aysén del General Carlos Ibáñez del Campo)','Buin (Provincia Maipo, Región Metropolitana de Santiago)','Bulnes (Provincia Diguillín, XVI Región de Ñuble)','Cabildo (Provincia Petorca, V Región de Valparaíso)','Cabo de Hornos (Provincia Antártica Chilena, XII Región de Magallanes y de la Antártica Chilena)','Cabrero (Provincia Bío Bío, VIII Región del Biobío)','Calama (Provincia El Loa, II Región de Antofagasta)','Calbuco (Provincia Llanquihue, X Región de Los Lagos)','Caldera (Provincia Copiapó, III Región de Atacama)','Calera de Tango (Provincia Maipo, Región Metropolitana de Santiago)','Calle Larga (Provincia Los Andes, V Región de Valparaíso)','Camarones (Provincia Arica, XV Región de Arica y Parinacota)','Camiña (Provincia Tamarugal, I Región de Tarapacá)','Canela (Provincia Choapa, IV Región de Coquimbo)','Cañete (Provincia Arauco, VIII Región del Biobío)','Carahue (Provincia Cautín, IX Región de la Araucanía)','Cartagena (Provincia San Antonio, V Región de Valparaíso)','Casablanca (Provincia Valparaíso, V Región de Valparaíso)','Castro (Provincia Chiloé, X Región de Los Lagos)','Catemu (Provincia San Felipe de Aconcagua, V Región de Valparaíso)','Cauquenes (Provincia Cauquenes, VII Región del Maule)','Cerrillos (Provincia Santiago, Región Metropolitana de Santiago)','Cerro Navia (Provincia Santiago, Región Metropolitana de Santiago)','Chaitén (Provincia Palena, X Región de Los Lagos)','Chanco (Provincia Cauquenes, VII Región del Maule)','Chañaral (Provincia Chañaral, III Región de Atacama)','Chépica (Provincia Colchagua, VI Región del Libertador General Bernardo O’Higgins)','Chiguayante (Provincia Concepción, VIII Región del Biobío)','Chile Chico (Provincia General Carrera, XI Región Aysén del General Carlos Ibáñez del Campo)','Chillán (Provincia Diguillín, XVI Región de Ñuble)','Chillán Viejo (Provincia Diguillín, XVI Región de Ñuble)','Chimbarongo (Provincia Colchagua, VI Región del Libertador General Bernardo O’Higgins)','Chol Chol (Provincia Cautín, IX Región de la Araucanía)','Chonchi (Provincia Chiloé, X Región de Los Lagos)','Cisnes (Provincia Aysén, XI Región Aysén del General Carlos Ibáñez del Campo)','Cobquecura (Provincia Itata, XVI Región de Ñuble)','Cochamó (Provincia Llanquihue, X Región de Los Lagos)','Cochrane (Provincia Capitán Prat, XI Región Aysén del General Carlos Ibáñez del Campo)','Codegua (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Coelemu (Provincia Itata, XVI Región de Ñuble)','Coihueco (Provincia Punilla, XVI Región de Ñuble)','Coinco (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Colbún (Provincia Linares, VII Región del Maule)','Colchane (Provincia Tamarugal, I Región de Tarapacá)','Colina (Provincia Chacabuco, Región Metropolitana de Santiago)','Collipulli (Provincia Malleco, IX Región de la Araucanía)','Coltauco (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Combarbalá (Provincia Limarí, IV Región de Coquimbo)','Concepción (Provincia Concepción, VIII Región del Biobío)','Conchalí (Provincia Santiago, Región Metropolitana de Santiago)','Concón (Provincia Valparaíso, V Región de Valparaíso)','Constitución (Provincia Talca, VII Región del Maule)','Contulmo (Provincia Arauco, VIII Región del Biobío)','Copiapó (Provincia Copiapó, III Región de Atacama)','Coquimbo (Provincia Elqui, IV Región de Coquimbo)','Coronel (Provincia Concepción, VIII Región del Biobío)','Corral (Provincia Valdivia, XIV Región de Los Ríos)','Coyhaique (Provincia Coyhaique, XI Región Aysén del General Carlos Ibáñez del Campo)','Cunco (Provincia Cautín, IX Región de la Araucanía)','Curacautín (Provincia Malleco, IX Región de la Araucanía)','Curacaví (Provincia Melipilla, Región Metropolitana de Santiago)','Curaco de Vélez (Provincia Chiloé, X Región de Los Lagos)','Curanilahue (Provincia Arauco, VIII Región del Biobío)','Curarrehue (Provincia Cautín, IX Región de la Araucanía)','Curepto (Provincia Talca, VII Región del Maule)','Curicó (Provincia Curicó, VII Región del Maule)','Dalcahue (Provincia Chiloé, X Región de Los Lagos)','Diego de Almagro (Provincia Chañaral, III Región de Atacama)','Doñihue (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','El Bosque (Provincia Santiago, Región Metropolitana de Santiago)','El Carmen (Provincia Diguillín, XVI Región de Ñuble)','El Monte (Provincia Talagante, Región Metropolitana de Santiago)','El Quisco (Provincia San Antonio, V Región de Valparaíso)','El Tabo (Provincia San Antonio, V Región de Valparaíso)','Empedrado (Provincia Talca, VII Región del Maule)','Ercilla (Provincia Malleco, IX Región de la Araucanía)','Estación Central (Provincia Santiago, Región Metropolitana de Santiago)','Florida (Provincia Concepción, VIII Región del Biobío)','Freire (Provincia Cautín, IX Región de la Araucanía)','Freirina (Provincia Huasco, III Región de Atacama)','Fresia (Provincia Llanquihue, X Región de Los Lagos)','Frutillar (Provincia Llanquihue, X Región de Los Lagos)','Futaleufú (Provincia Palena, X Región de Los Lagos)','Futrono (Provincia Ranco, XIV Región de Los Ríos)','Galvarino (Provincia Cautín, IX Región de la Araucanía)','General Lagos (Provincia Parinacota, XV Región de Arica y Parinacota)','Gorbea (Provincia Cautín, IX Región de la Araucanía)','Graneros (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Guaitecas (Provincia Aysén, XI Región Aysén del General Carlos Ibáñez del Campo)','Hijuelas (Provincia Quillota, V Región de Valparaíso)','Hualaihué (Provincia Palena, X Región de Los Lagos)','Hualañé (Provincia Curicó, VII Región del Maule)','Hualpén (Provincia Concepción, VIII Región del Biobío)','Hualqui (Provincia Concepción, VIII Región del Biobío)','Huara (Provincia Tamarugal, I Región de Tarapacá)','Huasco (Provincia Huasco, III Región de Atacama)','Huechuraba (Provincia Santiago, Región Metropolitana de Santiago)','Illapel (Provincia Choapa, IV Región de Coquimbo)','Independencia (Provincia Santiago, Región Metropolitana de Santiago)','Iquique (Provincia Iquique, I Región de Tarapacá)','Isla de Maipo (Provincia Talagante, Región Metropolitana de Santiago)','Isla de Pascua (Provincia Isla de Pascua, V Región de Valparaíso)','Juan Fernández (Provincia Valparaíso, V Región de Valparaíso)','La Calera (Provincia Quillota, V Región de Valparaíso)','La Cisterna (Provincia Santiago, Región Metropolitana de Santiago)','La Cruz (Provincia Quillota, V Región de Valparaíso)','La Estrella (Provincia Cardenal Caro, VI Región del Libertador General Bernardo O’Higgins)','La Florida (Provincia Santiago, Región Metropolitana de Santiago)','La Granja (Provincia Santiago, Región Metropolitana de Santiago)','La Higuera (Provincia Elqui, IV Región de Coquimbo)','La Ligua (Provincia Petorca, V Región de Valparaíso)','La Pintana (Provincia Santiago, Región Metropolitana de Santiago)','La Reina (Provincia Santiago, Región Metropolitana de Santiago)','La Serena (Provincia Elqui, IV Región de Coquimbo)','La Unión (Provincia Ranco, XIV Región de Los Ríos)','Lago Ranco (Provincia Ranco, XIV Región de Los Ríos)','Lago Verde (Provincia Coyhaique, XI Región Aysén del General Carlos Ibáñez del Campo)','Laguna Blanca (Provincia Magallanes, XII Región de Magallanes y de la Antártica Chilena)','Laja (Provincia Bío Bío, VIII Región del Biobío)','Lampa (Provincia Chacabuco, Región Metropolitana de Santiago)','Lanco (Provincia Valdivia, XIV Región de Los Ríos)','Las Cabras (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Las Condes (Provincia Santiago, Región Metropolitana de Santiago)','Lautaro (Provincia Cautín, IX Región de la Araucanía)','Lebu (Provincia Arauco, VIII Región del Biobío)','Licantén (Provincia Curicó, VII Región del Maule)','Limache (Provincia Marga Marga, V Región de Valparaíso)','Linares (Provincia Linares, VII Región del Maule)','Litueche (Provincia Cardenal Caro, VI Región del Libertador General Bernardo O’Higgins)','Llanquihue (Provincia Llanquihue, X Región de Los Lagos)','Llay Llay (Provincia San Felipe de Aconcagua, V Región de Valparaíso)','Lo Barnechea (Provincia Santiago, Región Metropolitana de Santiago)','Lo Espejo (Provincia Santiago, Región Metropolitana de Santiago)','Lo Prado (Provincia Santiago, Región Metropolitana de Santiago)','Lolol (Provincia Colchagua, VI Región del Libertador General Bernardo O’Higgins)','Loncoche (Provincia Cautín, IX Región de la Araucanía)','Longaví (Provincia Linares, VII Región del Maule)','Lonquimay (Provincia Malleco, IX Región de la Araucanía)','Los Álamos (Provincia Arauco, VIII Región del Biobío)','Los Andes (Provincia Los Andes, V Región de Valparaíso)','Los Ángeles (Provincia Bío Bío, VIII Región del Biobío)','Los Lagos (Provincia Valdivia, XIV Región de Los Ríos)','Los Muermos (Provincia Llanquihue, X Región de Los Lagos)','Los Sauces (Provincia Malleco, IX Región de la Araucanía)','Los Vilos (Provincia Choapa, IV Región de Coquimbo)','Lota (Provincia Concepción, VIII Región del Biobío)','Lumaco (Provincia Malleco, IX Región de la Araucanía)','Machalí (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)'];
        $comuna2=['Macul (Provincia Santiago, Región Metropolitana de Santiago)','Máfil (Provincia Valdivia, XIV Región de Los Ríos)','Maipú (Provincia Santiago, Región Metropolitana de Santiago)','Malloa (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Marchigüe (Provincia Cardenal Caro, VI Región del Libertador General Bernardo O’Higgins)','María Elena (Provincia Tocopilla, II Región de Antofagasta)','María Pinto (Provincia Melipilla, Región Metropolitana de Santiago)','Mariquina (Provincia Valdivia, XIV Región de Los Ríos)','Maule (Provincia Talca, VII Región del Maule)','Maullín (Provincia Llanquihue, X Región de Los Lagos)','Mejillones (Provincia Antofagasta, II Región de Antofagasta)','Melipeuco (Provincia Cautín, IX Región de la Araucanía)','Melipilla (Provincia Melipilla, Región Metropolitana de Santiago)','Molina (Provincia Curicó, VII Región del Maule)','Monte Patria (Provincia Limarí, IV Región de Coquimbo)','Mostazal (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Mulchén (Provincia Bío Bío, VIII Región del Biobío)','Nacimiento (Provincia Bío Bío, VIII Región del Biobío)','Nancagua (Provincia Colchagua, VI Región del Libertador General Bernardo O’Higgins)','Navidad (Provincia Cardenal Caro, VI Región del Libertador General Bernardo O’Higgins)','Negrete (Provincia Bío Bío, VIII Región del Biobío)','Ninhue (Provincia Itata, XVI Región de Ñuble)','Nogales (Provincia Quillota, V Región de Valparaíso)','Nueva Imperial (Provincia Cautín, IX Región de la Araucanía)','Ñuñoa (Provincia Santiago, Región Metropolitana de Santiago)','O’Higgins (Provincia Capitán Prat, XI Región Aysén del General Carlos Ibáñez del Campo)','Olivar (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Ollagüe (Provincia El Loa, II Región de Antofagasta)','Olmué (Provincia Marga Marga, V Región de Valparaíso)','Osorno (Provincia Osorno, X Región de Los Lagos)','Ovalle (Provincia Limarí, IV Región de Coquimbo)','Padre Hurtado (Provincia Talagante, Región Metropolitana de Santiago)','Padre Las Casas (Provincia Cautín, IX Región de la Araucanía)','Paihuano (Provincia Elqui, IV Región de Coquimbo)','Paillaco (Provincia Valdivia, XIV Región de Los Ríos)','Paine (Provincia Maipo, Región Metropolitana de Santiago)','Palena (Provincia Palena, X Región de Los Lagos)','Palmilla (Provincia Colchagua, VI Región del Libertador General Bernardo O’Higgins)','Panguipulli (Provincia Valdivia, XIV Región de Los Ríos)','Panquehue (Provincia San Felipe de Aconcagua, V Región de Valparaíso)','Papudo (Provincia Petorca, V Región de Valparaíso)','Paredones (Provincia Cardenal Caro, VI Región del Libertador General Bernardo O’Higgins)','Parral (Provincia Linares, VII Región del Maule)','Pedro Aguirre Cerda (Provincia Santiago, Región Metropolitana de Santiago)','Pelarco (Provincia Talca, VII Región del Maule)','Pelluhue (Provincia Cauquenes, VII Región del Maule)','Pemuco (Provincia Diguillín, XVI Región de Ñuble)','Pencahue (Provincia Talca, VII Región del Maule)','Penco (Provincia Concepción, VIII Región del Biobío)','Peñaflor (Provincia Talagante, Región Metropolitana de Santiago)','Peñalolén (Provincia Santiago, Región Metropolitana de Santiago)','Peralillo (Provincia Colchagua, VI Región del Libertador General Bernardo O’Higgins)','Perquenco (Provincia Cautín, IX Región de la Araucanía)','Petorca (Provincia Petorca, V Región de Valparaíso)','Peumo (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Pica (Provincia Tamarugal, I Región de Tarapacá)','Pichidegua (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Pichilemu (Provincia Cardenal Caro, VI Región del Libertador General Bernardo O’Higgins)','Pinto (Provincia Diguillín, XVI Región de Ñuble)','Pirque (Provincia Cordillera, Región Metropolitana de Santiago)','Pitrufquén (Provincia Cautín, IX Región de la Araucanía)','Placilla (Provincia Colchagua, VI Región del Libertador General Bernardo O’Higgins)','Portezuelo (Provincia Itata, XVI Región de Ñuble)','Porvenir (Provincia Tierra del Fuego, XII Región de Magallanes y de la Antártica Chilena)','Pozo Almonte (Provincia Tamarugal, I Región de Tarapacá)','Primavera (Provincia Tierra del Fuego, XII Región de Magallanes y de la Antártica Chilena)','Providencia (Provincia Santiago, Región Metropolitana de Santiago)','Puchuncaví (Provincia Valparaíso, V Región de Valparaíso)','Pucón (Provincia Cautín, IX Región de la Araucanía)','Pudahuel (Provincia Santiago, Región Metropolitana de Santiago)','Puente Alto (Provincia Cordillera, Región Metropolitana de Santiago)','Puerto Montt (Provincia Llanquihue, X Región de Los Lagos)','Puerto Natales (Provincia Última Esperanza, XII Región de Magallanes y de la Antártica Chilena)','Puerto Octay (Provincia Osorno, X Región de Los Lagos)','Puerto Varas (Provincia Llanquihue, X Región de Los Lagos)','Pumanque (Provincia Colchagua, VI Región del Libertador General Bernardo O’Higgins)','Punitaqui (Provincia Limarí, IV Región de Coquimbo)','Punta Arenas (Provincia Magallanes, XII Región de Magallanes y de la Antártica Chilena)','Puqueldón (Provincia Chiloé, X Región de Los Lagos)','Purén (Provincia Malleco, IX Región de la Araucanía)','Purranque (Provincia Osorno, X Región de Los Lagos)','Putaendo (Provincia San Felipe de Aconcagua, V Región de Valparaíso)','Putre (Provincia Parinacota, XV Región de Arica y Parinacota)','Puyehue (Provincia Osorno, X Región de Los Lagos)','Queilén (Provincia Chiloé, X Región de Los Lagos)','Quellón (Provincia Chiloé, X Región de Los Lagos)','Quemchi (Provincia Chiloé, X Región de Los Lagos)','Quilaco (Provincia Bío Bío, VIII Región del Biobío)','Quilicura (Provincia Santiago, Región Metropolitana de Santiago)','Quilleco (Provincia Bío Bío, VIII Región del Biobío)','Quillón (Provincia Diguillín, XVI Región de Ñuble)','Quillota (Provincia Quillota, V Región de Valparaíso)','Quilpué (Provincia Marga Marga, V Región de Valparaíso)','Quinchao (Provincia Chiloé, X Región de Los Lagos)','Quinta de Tilcoco (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Quinta Normal (Provincia Santiago, Región Metropolitana de Santiago)','Quintero (Provincia Valparaíso, V Región de Valparaíso)','Quirihue (Provincia Itata, XVI Región de Ñuble)','Rancagua (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Ránquil (Provincia Itata, XVI Región de Ñuble)','Rauco (Provincia Curicó, VII Región del Maule)','Recoleta (Provincia Santiago, Región Metropolitana de Santiago)','Renaico (Provincia Malleco, IX Región de la Araucanía)','Renca (Provincia Santiago, Región Metropolitana de Santiago)','Rengo (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Requínoa (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Retiro (Provincia Linares, VII Región del Maule)','Rinconada (Provincia Los Andes, V Región de Valparaíso)','Río Bueno (Provincia Ranco, XIV Región de Los Ríos)','Río Claro (Provincia Talca, VII Región del Maule)','Río Hurtado (Provincia Limarí, IV Región de Coquimbo)','Río Ibáñez (Provincia General Carrera, XI Región Aysén del General Carlos Ibáñez del Campo)','Río Negro (Provincia Osorno, X Región de Los Lagos)','Río Verde (Provincia Magallanes, XII Región de Magallanes y de la Antártica Chilena)','Romeral (Provincia Curicó, VII Región del Maule)','Saavedra (Provincia Cautín, IX Región de la Araucanía)','Sagrada Familia (Provincia Curicó, VII Región del Maule)','Salamanca (Provincia Choapa, IV Región de Coquimbo)','San Antonio (Provincia San Antonio, V Región de Valparaíso)','San Bernardo (Provincia Maipo, Región Metropolitana de Santiago)','San Carlos (Provincia Punilla, XVI Región de Ñuble)','San Clemente (Provincia Talca, VII Región del Maule)','San Esteban (Provincia Los Andes, V Región de Valparaíso)','San Fabián (Provincia Punilla, XVI Región de Ñuble)','San Felipe (Provincia San Felipe de Aconcagua, V Región de Valparaíso)','San Fernando (Provincia Colchagua, VI Región del Libertador General Bernardo O’Higgins)','San Gregorio (Provincia Magallanes, XII Región de Magallanes y de la Antártica Chilena)','San Ignacio (Provincia Diguillín, XVI Región de Ñuble)','San Javier (Provincia Linares, VII Región del Maule)','San Joaquín (Provincia Santiago, Región Metropolitana de Santiago)','San José de Maipo (Provincia Cordillera, Región Metropolitana de Santiago)','San Juan de la Costa (Provincia Osorno, X Región de Los Lagos)','San Miguel (Provincia Santiago, Región Metropolitana de Santiago)','San Nicolás (Provincia Punilla, XVI Región de Ñuble)','San Pablo (Provincia Osorno, X Región de Los Lagos)','San Pedro (Provincia Melipilla, Región Metropolitana de Santiago)','San Pedro de Atacama (Provincia El Loa, II Región de Antofagasta)','San Pedro de la Paz (Provincia Concepción, VIII Región del Biobío)','San Rafael (Provincia Talca, VII Región del Maule)','San Ramón (Provincia Santiago, Región Metropolitana de Santiago)','San Rosendo (Provincia Bío Bío, VIII Región del Biobío)','San Vicente de Tagua Tagua (Provincia Cachapoal, VI Región del Libertador General Bernardo O’Higgins)','Santa Bárbara (Provincia Bío Bío, VIII Región del Biobío)','Santa Cruz (Provincia Colchagua, VI Región del Libertador General Bernardo O’Higgins)','Santa Juana (Provincia Concepción, VIII Región del Biobío)','Santa María (Provincia San Felipe de Aconcagua, V Región de Valparaíso)','Santiago (Provincia Santiago, Región Metropolitana de Santiago)','Santo Domingo (Provincia San Antonio, V Región de Valparaíso)','Sierra Gorda (Provincia Antofagasta, II Región de Antofagasta)','Talagante (Provincia Talagante, Región Metropolitana de Santiago)','Talca (Provincia Talca, VII Región del Maule)','Talcahuano (Provincia Concepción, VIII Región del Biobío)','Taltal (Provincia Antofagasta, II Región de Antofagasta)','Temuco (Provincia Cautín, IX Región de la Araucanía)','Teno (Provincia Curicó, VII Región del Maule)','Teodoro Schmidt (Provincia Cautín, IX Región de la Araucanía)','Tierra Amarilla (Provincia Copiapó, III Región de Atacama)','Til Til (Provincia Chacabuco, Región Metropolitana de Santiago)','Timaukel (Provincia Tierra del Fuego, XII Región de Magallanes y de la Antártica Chilena)','Tirúa (Provincia Arauco, VIII Región del Biobío)','Tocopilla (Provincia Tocopilla, II Región de Antofagasta)','Toltén (Provincia Cautín, IX Región de la Araucanía)','Tomé (Provincia Concepción, VIII Región del Biobío)','Torres del Paine (Provincia Última Esperanza, XII Región de Magallanes y de la Antártica Chilena)','Tortel (Provincia Capitán Prat, XI Región Aysén del General Carlos Ibáñez del Campo)','Traiguén (Provincia Malleco, IX Región de la Araucanía)','Trehuaco (Provincia Itata, XVI Región de Ñuble)','Tucapel (Provincia Bío Bío, VIII Región del Biobío)','Valdivia (Provincia Valdivia, XIV Región de Los Ríos)','Vallenar (Provincia Huasco, III Región de Atacama)','Valparaíso (Provincia Valparaíso, V Región de Valparaíso)','Vichuquén (Provincia Curicó, VII Región del Maule)','Victoria (Provincia Malleco, IX Región de la Araucanía)','Vicuña (Provincia Elqui, IV Región de Coquimbo)','Vilcún (Provincia Cautín, IX Región de la Araucanía)','Villa Alegre (Provincia Linares, VII Región del Maule)','Villa Alemana (Provincia Marga Marga, V Región de Valparaíso)','Villarrica (Provincia Cautín, IX Región de la Araucanía)','Viña del Mar (Provincia Valparaíso, V Región de Valparaíso)','Vitacura (Provincia Santiago, Región Metropolitana de Santiago)','Yerbas Buenas (Provincia Linares, VII Región del Maule)','Yumbel (Provincia Bío Bío, VIII Región del Biobío)','Yungay (Provincia Diguillín, XVI Región de Ñuble)','Zapallar (Provincia Petorca, V Región de Valparaíso)'];

        $longitud = count($comuna1);
 
        //Recorro todos los elementos
        for($i=0; $i<$longitud; $i++)
        {
        
        comuna::create([
            'comuna'=>$comuna1[$i],
        ]);
        }

        $longitud = count($comuna2);
    
        //Recorro todos los elementos
        for($i=0; $i<$longitud; $i++)
        {
        
        comuna::create([
            'comuna'=>$comuna2[$i],
        ]);
        }

        variedad::create([
            
            'variedad'=>'N/A',
            'observacion'=>'N/A',
        ]);
        variedad::create([
            'variedad'=>'Endemica de SAntiago',
            'observacion'=>'Solo Cosechas',
        ]);
        especie::create([
            'especie'=>'N/A',
            'variedad_id'=>1,
            'metros2'=>0,
            'fechaCosecha'=>'2023-06-06',
            'distanciaPlanta'=>0,
            'observacion'=>'N/A',
        ]);
        especie::create([
            'especie'=>'Palta Hass',
            'variedad_id'=>1,
            'metros2'=>34,
            'fechaCosecha'=>'2023-06-06',
            'distanciaPlanta'=>3,
            'observacion'=>'Plantas de Paltas',
        ]);

    }
}
