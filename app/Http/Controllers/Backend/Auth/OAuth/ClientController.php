<?php
/**
 * User: amir
 * Date: 3/4/20
 * Time: 6:33 PM
 */

namespace App\Http\Controllers\Backend\Auth\OAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRequest;
use App\Repositories\Auth\ClientRepository;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index(AdminRequest $request)
    {
        return view('backend.auth.oauth.client.index')
            ->withClients($this->clientRepository->paginate($request->query->get('size', 25)));
    }

    public function show(AdminRequest $request, $client)
    {
        $client = $this->clientRepository->getById($client);

        if (!$client) {
            abort(404);
        }

        return view('backend.auth.oauth.client.show')
            ->withClient($client);
    }
}
