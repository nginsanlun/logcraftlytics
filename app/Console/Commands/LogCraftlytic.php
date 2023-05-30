<?php
namespace App\Console\Commands;

use App\Constants\LogConstant;
use App\Models\Method;
use App\Models\Status;
use App\Models\LogLevel;
use App\Models\RouteUrl;
use App\Models\LogAnalytic;
use Illuminate\Console\Command;

class LogCraftlytic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:craftlytic {log-file}';
    
   
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display log file';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function __construct(
        protected LogLevel $logLevel,
        protected Method $method,
        protected RouteUrl $route,
        protected Status $status,
        protected LogAnalytic $logAnalytic
    ) {
        parent::__construct();
    }
   
    public function handle()
    {
        $file = $this->argument('log-file');
        $filePath = storage_path($file);
        if (!file_exists($filePath)) {
            $this->error('File' . $filePath . 'not found');
            return;
        }

        $log = (file($filePath));
        $log = collect($log);
        
        $clean = collect();
        foreach (LogConstant::METHOD as $methods) {
            $clean[] = $log->filter(function ($val) use($methods) {
                if (str_contains($val, $methods)) {
                    return $val;
                }
            });
        }
        $clean = $clean->flatten()->all();
        $this->getLogAnalytic($clean);  
    }

    private function getLogAnalytic(array $clean) {
        $data = [
                'log_level_id' => '',
                'route_id' => '',
                'status_id' => '',
                'method_id' => ''
            ];
        foreach ($clean as $logs) {
            $logAnalytic = preg_split('/[\s ]/', $logs);
            $level = $logAnalytic[config('log.level')];
            $levelLog = preg_split('/[.:]/', $level);
            $method = $logAnalytic[config('log.method')];
            $status = $logAnalytic[config('log.status')];

	    if (
		    'INFO' != $levelLog[config('log.levelLog')] ||
	            !$method ||
	    	    !$status 
	    )   {
		    continue;
            }

	    $data = [
                'log_level_id'=> $this->logLevel->where('level', 'INFO')->first()?->id,
                'method_id' => $this->method->where('name', $method)->first()?->id,
                'status_id' => $this->status->where('status_code', $status)->first()?->id
	        ];
	    
	    if (count(array_filter($data)) < count($data)) {
		    continue;
	    }
            if($route = $logAnalytic[config('log.route')]) {
                $this->route->updateOrCreate([
                    'name' => $route
                ]);
                $data['route_id'] = $this->route->where('name', $route)->first()?->id;
            }
            $this->logAnalytic->create($data);
        }    
    }
}
