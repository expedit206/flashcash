<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProduitUser;
use App\Models\PromoCode;
use App\Models\PromoCodeUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends Controller
{
  
    // Utiliser un code promo
    public function usePromoCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);
    
        $userId = Auth::user()->id; // Utilisateur authentifié
        $code = $request->code;
    
        $promoCode = PromoCode::where('code', $code)->first();
    
        if ($promoCode && $promoCode->used_count < $promoCode->max_usage) {
            $usage = PromoCodeUser::where('user_id', $userId)->where('promo_code_id', $promoCode->id)->first();
    
            if (!$usage) {
                $user = User::find($userId);
    
                if ($this->canReceiveBonus($user)) {
                    $user->solde_total += 500;
                    $user->save();
    
                    // Enregistrez l'utilisation du code avec status 'success'
                    PromoCodeUser::create([
                        'user_id' => $userId,
                        'promo_code_id' => $promoCode->id,
                        'status' => 'success',
                    ]);
    
                    $promoCode->used_count += 1;
                    $promoCode->save();
    
                    session()->flash('message', 'Bonus de 500 ajouté à votre solde !');
                } else {
                    // Enregistrez l'utilisation avec status 'failed'
                    PromoCodeUser::create([
                        'user_id' => $userId,
                        'promo_code_id' => $promoCode->id,
                        'status' => 'failed',
                    ]);
    
                    session()->flash('message', 'Conditions non remplies pour recevoir le bonus.');
                }
            } else {
                // Enregistrer l'utilisation avec status 'failed'
                session()->flash('message', 'Vous avez déjà utilisé ce code.');
            }
        } else {
            // Enregistrer l'utilisation avec status 'failed'
            PromoCodeUser::create([
                'user_id' => $userId,
                'promo_code_id' => $promoCode?->id,
                'status' => 'failed',
            ]);
    
            session()->flash('message', 'Code promo invalide ou déjà utilisé.');
        }
    
        return redirect()->route('compte.show', $userId);
    }

    // Vérifiez si l'utilisateur peut recevoir le bonus
    private function canReceiveBonus($user)
    {
        $filleuls = User::where('parrain_id', $user->id)->count();
        $investments = ProduitUser::where('user_id', $user->id)->count();

        return $filleuls >= 2 && $investments > 0;
    }
}