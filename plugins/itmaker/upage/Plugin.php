<?php namespace Itmaker\Upage;

use Rainlab\User\Models\UserGroup;
use Event;
use System\Classes\PluginBase;
use Flash;
use Input;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
    
    public function registerMailTemplates()
    {
        return [
            'itmaker.upage::mail.activate'
        ];
    }
    
    public function boot() {
      \Rainlab\User\Models\User::extend(function($model){
        $model->addFillable([
          'phone'
        ]);
      });

      // now your actual code for extending fields
      \RainLab\User\Controllers\Users::extendFormFields(function($form, $model, $context){
            
            if (!$model instanceof \RainLab\User\Models\User)
                return;

            if (!$model->exists)
                return;

            $form->addTabFields([
                'phone' => [
                    'tab' => 'rainlab.user::lang.user.account',
                    'type'  => 'text',
                    'label' => 'Телефон',
                ]                
            ]);
        });

        // Extend all backend list usage
        Event::listen('backend.list.extendColumns', function($widget) {

            // Only for the User controller
            if (!$widget->getController() instanceof \RainLab\User\Controllers\Users) {
                return;
            }

            // Only for the User model
            if (!$widget->model instanceof \RainLab\User\Models\User) {
                return;
            }

            $widget->addColumns([
                'phone' => [
                    'label' => 'Phone'
                ]                
            ]);

            $widget->addColumns([
                'id' => [
                    'label' => 'ID'
                ]
            ]);
        });


        // extend user model with addUserGroup method
        \Rainlab\User\Models\User::extend(function($model) {
            $model->addDynamicMethod('addUserGroup', function($group) use ($model) {
                if ($group instanceof Collection) {
                    return $model->groups()->saveMany($group);
                }

                if (is_string($group)) {
                    $group = UserGroup::whereCode($group)->first();

                    return $model->groups()->save($group);
                }

                if ($group instanceof UserGroup) {
                    return $model->groups()->save($group);
                }
            });
        });

        // register user with selected group
        Event::listen('rainlab.user.register', function($user) {
            // Code to register $user->email to mailing list
            $userGroup = Input::only('groups');
            $user->addUserGroup(UserGroup::whereCode($userGroup)->first());
        });

        
    }
}
