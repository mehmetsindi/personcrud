<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# basicpersoncrud
Basic Person Crud App

## Features



## Installation and Configuration

From the command line run
```shell
composer install
```

```shell
php artisan migrate
```


## Routes

Route::get('/person', [PersonController::class, 'worker']);

Route::post('/person', [PersonController::class, 'worker']);

## Controller

class PersonController extends Controller
{
    use Picker;

    public function worker()
    {
        $fuseAction = $this->getFuseAction();

        $data = $this->pickUp();

        $error = $data['error'] ?? false;

        if ($fuseAction == 'update' || $fuseAction == 'delete' || $fuseAction == 'store') {
            return redirect('/person')->withErrors(['message' => $error]);
        }

        return view('client.customer.layout.' . $fuseAction)->with(['data' => $data]);
    }
}


## Pickup Model and GetMethod


    public function pickUp()
    {
        try {

            $fuse = $this->getFuse();
            $fuseAction = $this->getFuseAction();

            if (!in_array($fuse, array_keys($this->fuse()))) {
                throw new \Exception('fuse is not correct');
            }

            if (!in_array($fuseAction, array_keys($this->fuseAction()))) {
                throw new \Exception('fuse action is not correct');
            }

            $model = $this->pickModel($fuse);
            $method = $this->pickMethod($fuseAction);

            $fuseAction = Str::ucfirst($fuseAction);

            return $this->$method(new $model);

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    
    
    
## Store Method
    
        public function getStore($model)
    {

        try {
            if (!($model instanceof Model)) {
                throw new \ErrorException('model is not correct');
            }

            if ($this->validator()['status']) {
                throw new \ErrorException($this->validator()['message']['name'][0] ?? 'validation error');
            }

            $model->slug = SlugGenerator::generateSlug();

            foreach ($model->getFillable() as $m) {
                $model->$m = request(Str::camel($m));
            }

            $model->is_active = 1;

            if (!$model->save()) {
                return  new Exception('failed to save');
            }
            return true;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
## Read Method
    
        public function getRead($model)
    {
        try {
            if (!($model instanceof Model)) {
                throw new \ErrorException('model is not correct');
            }
            $data = app(Pipeline::class)
                ->send($model)
                ->through(
                    Sort::class,
                    Slug::class,
                    Name::class,
                )
                ->thenReturn()
                ->requirement()
                ->paginate(12);
            return $data;

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    
## Update Method
    
        public function getUpdate($model)
    {
        try {
            if (!($model instanceof Model)) {
                throw new \ErrorException('model is not correct');
            }

            $data = request()->all();

            $pickUpdate = UpdateHelper::setUpdate($model, $data);

            $model = $model->where('slug', request('slug'))->first();

            foreach ($pickUpdate as $m) {
                !array_key_exists(Str::camel($m), $data) ?: $model->$m = $data[Str::camel($m)] ?? null;
            }

            if (!$model->save()) {
                throw new \ErrorException('could not update');
            }
            return $data;

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    
## Delete Method
    
        public function getDelete($model)
    {
        try {
            if (!($model instanceof Model)) {
                throw new \ErrorException('model is not correct');
            }

            $model->where('slug', request('slug'))->delete();

            return true;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

## Validation Object
    
    
    class PersonStoreValidation
    {
        public function postValidate()
        {
            $validator = Validator::make(request()->all(),
                [
                    'name' => ['required' , 'max:255', 'min:2'],
                ]
            );

            return [
                'status' => $validator->fails() ? true : false,
                'message' => $validator->errors()->toArray() ?? 'Custom Validate No Error'
            ];
        }
    }
