<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balance;
Use App\Models\Historic;
use App\Http\Requests\MoneyValidationFormRequest;

class BalanceController extends Controller
{
    private $totalPage = 10;
    
    public function index()
    {
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;

        return view('admin.balance.index', compact('amount'));
    }

    public function deposit() 
    {
    	return view('admin.balance.deposit');
    }

    public function depositStore(MoneyValidationFormRequest $request)
    {
    	//dd($request->all());
    	
    	$balance = auth()->user()->balance()->firstOrCreate([]);
    	$response = $balance->deposit($request->value);

    	if ($response['success'])
    		return redirect()
    					->route('admin.balance')
    					->with('success',$response['message']);

    	return redirect()
    					->back()
    					->with('error',$response['message']);
    }

    public function withdrawn() 
    {
    	return view('admin.balance.withdrawn');
    }

    public function withdrawnStore(MoneyValidationFormRequest $request)
    {
    	//dd($request->all());
    	
    	$balance1 = auth()->user()->balance()->firstOrCreate([]);
    	$response = $balance1->withdrawn($request->value);

    	if ($response['success'])
    		return redirect()
    					->route('admin.balance')
    					->with('success',$response['message']);

    	return redirect()
    					->back()
    					->with('error',$response['message']);
    }

    public function transfer() 
    {
    	return view('admin.balance.transfer');
    }

    public function confirmTransfer(Request $request, User $user)
	{
		if (!$sender = $user->getSender($request->sender))
			return redirect()
						->back()
						->with('error','Usuário informado não foi encontrado!');

		if ($sender->id === auth()->user()->id)
			return redirect()
						->back()
						->with('error','não pode transferir para você mesmo!');

		$balance = auth()->user()->balance;

		return view('admin.balance.transfer-confirm', compact('sender', 'balance'));

	}

    public function transferStore(MoneyValidationFormRequest $request, User $user)
	{
		if (!$sender = $user->find($request->sender_id))
			return redirect()
						->route('balance.transfer')
						->with('success', 'Recebedor não encontrado!');

		$balance1 = auth()->user()->balance()->firstOrCreate([]);
    	$response = $balance1->transfer($request->value, $sender);

    	if ($response['success'])
    		return redirect()
    					->route('admin.balance')
    					->with('success',$response['message']);

    	return redirect()
    					->route('balance.transfer')
    					->with('error',$response['message']);
	}

    public function historic(Historic $historic)
	{
		$historics = auth()->user()->historics()->with(['userSender'])->paginate($this->totalPage);

		$types = $historic->type();

		return view('admin.balance.historics', compact('historics', 'types'));
	}

	public function searchHistoric(Request $request, Historic $historic)
	{
		//dd($request->all()); 
		$dataForm = $request->except('_token');

		$historics = $historic->search($dataForm, $this->totalPage);

		$types = $historic->type();

		return view('admin.balance.historics', compact('historics', 'types', 'dataForm'));

	}
    
}
