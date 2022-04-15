@foreach($files as $file)
<!--each row-->
<tr id="file_{{ $file->file_id }}">
    @if(config('visibility.files_col_checkboxes'))
    <td class="files_col_checkbox checkitem" id="files_col_checkbox_{{ $file->file_id }}">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-files-{{ $file->file_id }}" name="ids[{{ $file->file_id }}]"
                class="listcheckbox listcheckbox-files filled-in chk-col-light-blue"
                data-actions-container-class="files-checkbox-actions-container">
            <label for="listcheckbox-files-{{ $file->file_id }}"></label>
        </span>
    </td>
    @endif
    <td class="files_col_file" id="files_col_file_{{ $file->file_id }}">
        @if($file->file_type == 'image')
        <!--dynamic inline style-->
        <div>
            <a class="fancybox preview-image-thumb" href="storage/files/{{ $file->file_directory }}/{{ $file->file_filename  }}" title="{{ str_limit($file->file_filename, 60) }}" alt="{{ str_limit($file->file_filename, 60) }}">
                <img class="lists-table-thumb" src="{{ url('storage/files/' . $file->file_directory .'/'. $file->file_thumbname) }}">
			</a>
        </div>
        @else
        <div class="lists-table-thumb">
            <a class="preview-image-thumb" href="files/download?file_id={{ $file->file_uniqueid }}" download>
                {{ $file->file_extension }}
            </a>
        </div>
        @endif
    </td>
    <td class="files_col_file_name" id="files_col_file_name_{{ $file->file_id }}">
        <a href="{{ url('files/download?file_id=' . $file->file_uniqueid) }}"
            title="{{ $file->file_filename ?? '---' }}" download>{{ str_limit($file->file_filename ?? '---', 70) }}</a>
    </td>
    <td class="files_col_added_by" id="files_col_added_by_{{ $file->file_id }}">
        <img src="{{ getUsersAvatar($file->avatar_directory, $file->avatar_filename) }}" alt="user"
            class="img-circle avatar-xsmall">
        {{ $file->first_name ?? runtimeUnkownUser() }}
    </td>
    <td class="files_col_size" id="files_col_size_{{ $file->file_id }}">{{ $file->file_size }}</td>
    <td class="files_col_date" id="files_col_date_{{ $file->file_id }}">
        {{ runtimeDate($file->file_created) }}
    </td>
    @if(config('visibility.files_col_visibility'))
    <td class="files_col_visible_to_client" id="files_col_visible_to_client_{{ $file->file_id }}">
        <div class="switch" id="file_edit_visibility_{{ $file->file_id }}">
            <label>
                <input {{ runtimePrechecked($file['file_visibility_client'] ?? '') }} type="checkbox"
                    class="js-ajax-ux-request-default" name="visible_to_client"
                    id="visible_to_client_{{ $file->file_id }}" data-url="{{ url('/files') }}/{{ $file->file_id }}"
                    data-ajax-type="PUT" data-type="form" data-form-id="file_edit_visibility_{{ $file->file_id }}"
                    data-progress-bar='hidden'>
                <span class="lever switch-col-light-blue"></span>
            </label>
        </div>
    </td>
    @endif
    
</tr>
@endforeach
<!--each row-->