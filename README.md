# Esponsor eCommerce builder

##Tegnologias utilizadas
- PHP (Laravel)
- JS (Vue)
- CSS (Tailwind)
- HTML5

## Requisitos
- PHP >= 7.4
- MySql version >= 8.0.22.

## ¿Como instalar?

- Clonar este repositorio.
- Correr  <code>composer install</code>
- Crear una base de datos local
- Crear una base de datos local para pruebas
- Crear un archivo <code>.env</code>, basado en <code>.env.example</code>
- Configurar <code>.env</code>
- Correr <code>php artisan test</code> para validar que la api este funcionando
- Correr <code>php artisan migrate</code>
- Corre <code>php artisan db:seed --class=CategoryTableSeeder</code> para agregar categorias de productos temporales

##TODO
- Funcionalidad para eliminar productos
- Validaciones de existencias
- Mostrar listado de compras realizadas
- Reporte ventas
- Implementar pasarela de pago
- Permitir agregar mas productos al carrito
