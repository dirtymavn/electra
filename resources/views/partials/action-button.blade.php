@if( isset( $show_url ) )
<a href="{!! empty( $show_url ) ? 'javascript:void(0)' : $show_url !!}" class="btn btn-primary btn-xs {!! empty( $show_url ) ? 'disabled' : '' !!}" title="Show" data-button="show">
    <i class="fa fa-search fa-fw"></i>
</a>
@endif
@if( isset( $edit_url ) )
<a href="{!! empty( $edit_url ) ? 'javascript:void(0)' : $edit_url !!}" class="btn btn-success btn-xs {!! empty( $edit_url ) ? 'disabled' : '' !!}" title="Edit" data-button="edit">
    <i class="fa fa-pencil-square-o fa-fw"></i>
</a>
@endif
@if( isset( $delete_url ) )
    <a href="javascript:void(0)" id="deleteData" class="btn btn-danger btn-xs deleteData {!! empty( $delete_url ) ? 'disabled' : '' !!}" title="Delete" data-href="{!! empty( $delete_url ) ? 'javascript:void(0)' : $delete_url !!}" data-button="delete">
        <i class="fa fa-trash-o fa-fw"></i>
    </a>
@endif
@if( isset( $status ) )
    <label class="switch">
        <input type="checkbox" {!! ($status == 1 || $status != null) ? 'checked' : '' !!} id="updateStatus" data-href="{!! $updateStatus_url !!}" data-button="{!! ($status != null)?$status:0 !!}">
        <div class="slider round" data-href="{!! $updateStatus_url !!}" data-button="{!! ($status != null)?$status:0 !!}"></div>
    </label>
@endif
@if( isset( $accept_url ) )
    <a href="javascript:void(0)" id="acceptData" class="btn btn-success btn-xs {!! empty( $accept_url ) ? 'disabled' : '' !!}" title="Accept" data-href="{!! empty( $accept_url ) ? 'javascript:void(0)' : $accept_url !!}" data-button="Accept">
        <i class="fa fa-check-square fa-fw"></i>
    </a>
@endif
@if( isset( $decline_url ) )
    <a href="javascript:void(0)" id="declineData" class="btn btn-danger btn-xs {!! empty( $decline_url ) ? 'disabled' : '' !!}" title="Decline" data-href="{!! empty( $decline_url ) ? 'javascript:void(0)' : $decline_url !!}" data-button="Decline">
        <i class="fa fa-window-close fa-fw"></i>
    </a>
@endif
@if( isset( $reset ) )
    <a href="javascript:void(0)" id="resetData" class="btn btn-primary btn-xs {!! empty( $reset ) ? 'disabled' : '' !!}" title="Reset Password" data-href="{!! empty( $reset ) ? 'javascript:void(0)' : $reset !!}" data-button="Reset Password">
        <i class="fa fa-refresh fa-fw"></i>
    </a>
@endif
