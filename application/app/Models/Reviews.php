<?phpnamespace App\Models;use Illuminate\Foundation\Auth\User as Authenticatable;use Illuminate\Notifications\Notifiable;use Illuminate\Support\Facades\Storage;use Cache;class Reviews extends Authenticatable {    use Notifiable;	protected $table = 'reviews_employee';	    protected $primaryKey = 'reviewemployee_id';    protected $dateFormat = 'Y-m-d H:i:s';   	const CREATED_AT = 'review_created';    const UPDATED_AT = 'review_updated';    }