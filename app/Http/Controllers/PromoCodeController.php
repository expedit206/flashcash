<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EpargneUser;
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
    // dump($promoC ode);
        if ($promoCode && $promoCode->used_count < $promoCode->max_usage) {
            $usage = PromoCodeUser::where('user_id', $userId)
                ->where('promo_code_id', $promoCode->id)
                ->first();
    
            if ($usage) {
                // Si l'utilisateur a déjà utilisé le code, vérifiez si le statut est 'failed'
                if ($usage->status === 'failed') {
                    // Si le statut est 'failed', on ne change pas le statut
                    session()->flash('message', 'Vous avez déjà utilisé ce code avec un échec.');
                } else {
                    // Si l'utilisateur a déjà réussi
                    session()->flash('message', 'Vous avez déjà utilisé ce code.');
                }
            } else {
                // C'est la première utilisation, vérifiez les conditions
                $user = User::find($userId);
    
                if ($this->canReceiveBonus($user)) {
                    // L'utilisateur remplit les conditions
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
    
                    session()->flash('message', 'Félicitations !!! Vous venez de gagner 500 XAF de bonus !');
                } else {
                    // Enregistrez l'utilisation avec status 'failed'
                    PromoCodeUser::create([
                        'user_id' => $userId,
                        'promo_code_id' => $promoCode->id,
                        'status' => 'failed',
                    ]);
    
                    session()->flash('message', 'Conditions non remplies pour recevoir le bonus. *Investissez sur le produit T-Cash-1(5000 XAF). ');
                }
            }
        } else {
            // die;

            // Enregistrer l'utilisation avec status 'failed'
            
            if(!$promoCode){
                PromoCodeUser::create([
                    'user_id' => $userId,
                    'promo_code_id' => $promoCode?->id,
                    'status' => 'failed',
                ]);

                session()->flash('message', 'Code promo invalide.');
            }else{

                session()->flash('message', 'Code promo expiré');
            }
        }
    
        return redirect()->route('compte.show', $userId);
    }

    // Vérifiez si l'utilisateur peut recevoir le bonus
  // Vérifiez si l'utilisateur peut recevoir le bonus
private function canReceiveBonus($user)
{
    // Comptez le nombre d'investissements
    $investments = ProduitUser::where('user_id', $user->id)
    ->where('produit_id', 2) ->count();
    // dd()
    // Vérifiez les conditions
    return $investments;
}
}
