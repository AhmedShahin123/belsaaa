<?php
/**
 * User: amir
 * Date: 3/4/20
 * Time: 6:33 PM
 */

namespace App\Http\Controllers\Backend\Auth\OAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRequest;
use App\Repositories\Auth\TokenRepository;

class TokenController extends Controller
{
    /**
     * @var TokenRepository
     */
    private $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function index(AdminRequest $request)
    {
        return view('backend.auth.oauth.token.index')
            ->withTokens($this->tokenRepository->paginate($request->query->get('size', 25)));
    }

    public function show(AdminRequest $request, TokenRepository $tokenRepository, $token)
    {
        $token = $this->tokenRepository->getById($token);

        if (!$token) {
            abort(404);
        }

        return view('backend.auth.oauth.token.show')
            ->withToken($token);
    }
}
