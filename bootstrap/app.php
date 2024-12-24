<?php

use App\Exceptions\BaseException;
use App\Utils\ResponseUtil;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
                  ->withRouting(
                    web:      __DIR__ . '/../routes/web.php',
                    api:      __DIR__ . '/../routes/api.php',
                    commands: __DIR__ . '/../routes/console.php',
                    health:   '/up',
                  )
                  ->withMiddleware(function (Middleware $middleware) {
                      //
                  })
                  ->withExceptions(function (Exceptions $exceptions) {
                      $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
                          if ($request->is('api/*')) {
                              return false;
                          }

                          return $request->expectsJson();
                      });

                      $exceptions->render(function (BaseException $e) {
                          return response()->json(
                            data:    ResponseUtil::sendError($e->getMessage()),
                            status:  Response::HTTP_CONFLICT,
                            headers: ['Content-Type' => 'application/json']
                          );
                      });
                  })->create();
