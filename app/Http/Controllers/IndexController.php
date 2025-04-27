<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use App\Models\CustomerNotification;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController
{

    public function index()
    {
        $notificationQuery = CustomerNotification::query()
            ->select([
                'message',
                'created_at',
                'updated_at',
            ])
            ->selectRaw('group_concat(address_id separator ", ") as address_ids')
            ->groupBy('message', 'created_at', 'updated_at')
            ->orderBy('created_at', 'desc')
            ->limit(6);

        if (!Auth::guest()) {
            $notificationQuery->where('address_id', Auth::user()->address_id);
        }

        $notification = $notificationQuery->get();

        return view('index', compact('notification'));
    }

    public function register()
    {
        $addressList = Address::query()
            ->get();
        $addressList = $addressList->map(function (Address $address) {
            return [
                'id' => $address->id,
                'address' => $address->getFullAttribute(),
            ];
        });

        return view('registration', compact('addressList'));
    }

    public function login()
    {
        return view('login');
    }

    public function authorize(Request $request)
    {
        $email = $request->input('login');
        $password = $request->input('password');

        $customer = Customer::query()
            ->where(filter_var($email, FILTER_VALIDATE_EMAIL) ? 'email' : 'number', $email)
            ->latest()
            ->first();

        if (!$customer) {
            session()->flash('message', 'Неверное имя пользователя или пароль');
            return redirect(route('sign-in'));
        }

        if (!Hash::check($password, $customer->password)) {
            session()->flash('message', 'Неверный пароль');
            return redirect(route('sign-in'));
        }

        Auth::login($customer);

        return redirect(route('lk'));
    }

    public function registration(Request $request)
    {
        $request->validate([
            'fullname' => ['required', 'regex:/^[А-ЯЁ][а-яё]+( [А-ЯЁ][а-яё]+){1,2}$/u'],
            'email' => ['required', 'unique:customers', 'email'],
            'password' => ['required', 'min:8'],
            'phone' => ['unique:customers,number'],
        ]);

        $email = $request->input('email');
        $phone = $request->input('phone');
        $fullname = $request->input('fullname');
        $address = $request->input('address');
        $password = $request->input('password');
        $password = Hash::make($password);

        $customer = Customer::query()
            ->where('email', $email)
            ->first();
        if ($customer) {
            session()->flash('message', 'Данный email уже занят');
            return redirect(route('sign-up'));
        }

        [$middleName, $name, $surName] = explode(' ', $fullname);

        $customer = new Customer();
        $customer->email = $email;
        $customer->number = $phone;
        $customer->name = $name;
        $customer->address_id = $address;
        $customer->password = $password;
        $customer->middle_name = $middleName;
        $customer->last_name = $surName;
        $customer->save();

        Auth::login($customer);

        return redirect(route('lk'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('home'));
    }

    public function feedbackPage()
    {
        return view('feedback');
    }

    public function feedback(Request $request)
    {
        $subject = $request->input('subject');
        $message = $request->input('body');

        $feedback = new Feedback();
        $feedback->subject = $subject;
        $feedback->message = $message;
        $feedback->customer_id = Auth::id();
        $feedback->save();

        session()->flash('message', 'Отзыв успешно отправлен!');

        return redirect(route('lk'));
    }

    public function request()
    {
        return view('request');
    }

    public function requestAction(Request $request)
    {
        $phone = $request->input('phone');
        $title = $request->input('title');

        $request = new \App\Models\Request();
        $request->title = $title;
        $request->customer_id = Auth::id();
        $request->phone = $phone;
        $request->user_id = User::query()
            ->where('id', 1)
            ->first()->id;
        $request->save();

        session()->flash('requestMessage', 'Заявка успешно отправлена и вскоре вам перезвонят');

        return redirect(route('lk'));
    }

    public function lk()
    {
        $user = Auth::user();

        $feedbackList = Feedback::query()
            ->where('customer_id', Auth::id())
            ->get();
        $requestsList = \App\Models\Request::query()
            ->where('customer_id', Auth::id())
            ->get();

        $addressList = Address::query()
            ->get();
        $addressList = $addressList->map(function (Address $address) {
            return [
                'id' => $address->id,
                'address' => $address->getFullAttribute(),
            ];
        });

        return view('lk', compact('user', 'feedbackList', 'requestsList', 'addressList'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . auth()->id(),
            'phone' => 'string|max:255|unique:customers,number,' . auth()->id(),
        ]);

        $customer = Auth::user();
        [$middleName, $name, $surName] = explode(' ', $request->name);

        $customer->email = $request->email;
        $customer->number = $request->phone;
        $customer->name = $name;
        $customer->middle_name = $middleName;
        $customer->last_name = $surName;

        $customer->save();

        return redirect(route('lk'));
    }

}
