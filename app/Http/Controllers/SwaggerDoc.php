<?php

namespace App\Http\Controllers;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="API Gestion",
 *         version="1.0.0",
 *         description="Documentation de l'API",
 *         @OA\Contact(
 *             email="support@tonapp.com"
 *         )
 *     ),
 *     @OA\Server(
 *         url=L5_SWAGGER_CONST_HOST,
 *         description="Serveur principal"
 *     )
 * )
 */
class SwaggerDoc extends Controller {}
