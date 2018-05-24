@if( isset( $show_url ) )
<a href="{!! empty( $show_url ) ? 'javascript:void(0)' : $show_url !!}" class="{!! empty( $show_url ) ? 'disabled' : '' !!}" title="Show" data-button="show">
    <i class="fa fa-search fa-fw"></i>
</a>
@endif
@if( isset( $edit_url ) )
<a href="{!! empty( $edit_url ) ? 'javascript:void(0)' : $edit_url !!}" class="{!! empty( $edit_url ) ? 'disabled' : '' !!}" title="Edit" data-button="edit">
    <i class="os-icon os-icon-ui-49"></i>
</a>
@endif
@if( isset( $reset_pass_url ) )
    <a href="javascript:void(0)" id="resetData" class="resetData {!! empty( $reset_pass_url ) ? 'disabled' : '' !!}" title="Reset Password" data-href="{!! empty( $reset_pass_url ) ? 'javascript:void(0)' : $reset_pass_url !!}" data-button="reset">
        <i class="os-icon os-icon-grid-18"></i>
    </a>
@endif
@if( isset( $approve_url ) )
    <a href="javascript:void(0)" id="approveData" style="color:#71c21a;" class="{!! empty( $approve_url ) ? 'disabled' : '' !!}" title="Approve" data-href="{!! empty( $approve_url ) ? 'javascript:void(0)' : $approve_url !!}" data-button="Approve">
        <i class="fa fa-check"></i>
    </a>
@endif
@if( isset( $reject_url ) )
    <a href="javascript:void(0)" id="rejectData" class="danger{!! empty( $reject_url ) ? 'disabled' : '' !!}" title="Reject" data-href="{!! empty( $reject_url ) ? 'javascript:void(0)' : $reject_url !!}" data-button="Reject">
        <i class="fa fa-times"></i>
    </a>
@endif
@if( isset( $delete_url ) )
    <a href="javascript:void(0)" id="deleteData" class="danger deleteData {!! empty( $delete_url ) ? 'disabled' : '' !!}" title="Delete" data-href="{!! empty( $delete_url ) ? 'javascript:void(0)' : $delete_url !!}" data-button="delete">
        <i class="os-icon os-icon-ui-15"></i>
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

