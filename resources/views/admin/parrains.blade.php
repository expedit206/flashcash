<!-- resources/views/users/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Utilisateurs Parrainant d'Autres Utilisateurs</h1>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Lien de Parrainage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersWhoReferOthers as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->referral_link }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection