<?phpnamespace App\Models;use Illuminate\Foundation\Auth\User as Authenticatable;use Illuminate\Notifications\Notifiable;use Illuminate\Support\Facades\Storage;use Cache;class GroupRooms extends Authenticatable {    use Notifiable;	protected $table = 'group_room';	    protected $primaryKey = 'grouproom_id';    protected $dateFormat = 'Y-m-d H:i:s';   	const CREATED_AT = 'grouproom_created';    const UPDATED_AT = 'grouproom_updated';    }