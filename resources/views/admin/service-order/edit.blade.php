<?php
use App\Models\ServiceOrder;
$title = ($item->id ? 'Edit' : 'Buat') . ' Order Servis';
?>
@extends('admin._layouts.default', [
    'title' => $title,
    'menu_active' => 'sales',
    'nav_active' => 'service-order',
    'form_action' => url('admin/service-order/edit/' . (int) $item->id),
])
@section('right-menu')
  <li class="nav-item">
    <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-save mr-1"></i> Simpan</button>
    <a onclick="return confirm('Batalkan perubahan?')" class="btn btn-default" href="{{ url('/admin/service-order/') }}"><i
        class="fas fa-cancel mr-1"></i>Batal</a>
  </li>
@endSection
@section('content')
  <input type="hidden" name="id" value="{{ $item->id }}">
  <div class="row justify-content-start">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <h4 class="mb-0">Pelanggan</h4>
          <hr class="mt-0">
          <div class="form-group">
            <label for="customer_id">Kode Pelanggan:</label>
            <select class="form-control select2 custom-select" name="customer_id" id="customer_id">
              <option value="">PELANGGAN BARU</option>
              @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" {{ $customer->id == $item->customer_id ? 'selected' : '' }}>
                  {{ $customer->idFormatted() . ' - ' . $customer->name }}</option>
              @endforeach
            </select>
            @error('customer_id')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="customer_name">Nama:</label>
            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name"
              placeholder="Masukkan Nama Pelanggan" name="customer_name"
              value="{{ old('customer_name', $item->customer_name) }}">
            @error('customer_name')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="customer_phone">Kontak:</label>
            <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" id="customer_phone"
              placeholder="Masukkan Kontak Pelanggan" name="customer_phone"
              value="{{ old('customer_phone', $item->customer_phone) }}">
            @error('customer_phone')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="customer_address">Alamat:</label>
            <input type="text" class="form-control @error('customer_address') is-invalid @enderror"
              id="customer_address" placeholder="Masukkan Alamat Pelanggan" name="customer_address"
              value="{{ old('customer_address', $item->customer_address) }}">
            @error('customer_address')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="mb-0">Perangkat</h4>
          <hr class="mt-0">
          <div class="form-group">
            <label for="device_type">Jenis Perangkat:</label>
            <input type="text" class="form-control @error('device_type') is-invalid @enderror" id="device_type"
              placeholder="Masukkan Jenis Perangkat" name="device_type" list="device_type_options"
              value="{{ old('device_type', $item->device_type) }}">
            <datalist id="device_type_options">
              @foreach ($device_types as $type)
                <option value="{{ $type }}">
              @endforeach
            </datalist>
            @error('device_type')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="device">Perangkat:</label>
            <input type="text" class="form-control @error('device') is-invalid @enderror" id="device"
              placeholder="Masukkan Perangkat" name="device" list="device_options"
              value="{{ old('device', $item->device) }}">
            <datalist id="device_options">
              @foreach ($devices as $device)
                <option value="{{ $device }}">
              @endforeach
            </datalist>
            @error('device_type')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="equipments">Kelengkapan:</label>
            <input type="text" class="form-control @error('equipments') is-invalid @enderror" id="equipments"
              placeholder="Kelengkapan" name="equipments" value="{{ old('equipments', $item->equipments) }}">
            @error('equipments')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="device_sn">SN / IMEI:</label>
            <input type="text" class="form-control @error('device_sn') is-invalid @enderror" id="device_sn"
              placeholder="SN" name="device_sn" value="{{ old('device_sn', $item->device_sn) }}">
            @error('device_sn')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <h4 class="mb-0">Servis</h4>
          <hr class="mt-0">
          <div class="form-group">
            <label for="problems">Keluhan:</label>
            <input type="text" class="form-control @error('problems') is-invalid @enderror" id="problems"
              name="problems" value="{{ old('problems', $item->problems) }}">
            @error('problems')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="actions">Tindakan:</label>
            <input type="text" class="form-control @error('actions') is-invalid @enderror" id="actions"
              name="actions" value="{{ old('actions', $item->actions) }}">
            @error('actions')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="service_status">Status Servis:</label>
            <select class="custom-select select2 form-control" id="service_status" name="service_status">
              <option value="{{ ServiceOrder::SERVICE_STATUS_NOT_YET_CHECKED }}"
                {{ $item->service_status == ServiceOrder::SERVICE_STATUS_NOT_YET_CHECKED ? 'selected' : '' }}>
                {{ ServiceOrder::formatServiceStatus(ServiceOrder::SERVICE_STATUS_NOT_YET_CHECKED) }}</option>
              <option value="{{ ServiceOrder::SERVICE_STATUS_CHECKED }}"
                {{ $item->service_status == ServiceOrder::SERVICE_STATUS_CHECKED ? 'selected' : '' }}>
                {{ ServiceOrder::formatServiceStatus(ServiceOrder::SERVICE_STATUS_CHECKED) }}</option>
              <option value="{{ ServiceOrder::SERVICE_STATUS_WORKED }}"
                {{ $item->service_status == ServiceOrder::SERVICE_STATUS_WORKED ? 'selected' : '' }}>
                {{ ServiceOrder::formatServiceStatus(ServiceOrder::SERVICE_STATUS_WORKED) }}</option>
              <option value="{{ ServiceOrder::SERVICE_STATUS_SUCCESS }}"
                {{ $item->service_status == ServiceOrder::SERVICE_STATUS_SUCCESS ? 'selected' : '' }}>
                {{ ServiceOrder::formatServiceStatus(ServiceOrder::SERVICE_STATUS_SUCCESS) }}</option>
              <option value="{{ ServiceOrder::SERVICE_STATUS_FAILED }}"
                {{ $item->service_status == ServiceOrder::SERVICE_STATUS_FAILED ? 'selected' : '' }}>
                {{ ServiceOrder::formatServiceStatus(ServiceOrder::SERVICE_STATUS_FAILED) }}</option>
            </select>
          </div>
          <div class="form-group">
            <label for="date_received">Tanggal Diterima:</label>
            <input type="date" class="form-control @error('date_received') is-invalid @enderror" id="date_received"
              name="date_received" value="{{ old('date_received', $item->date_received) }}">
            @error('date_received')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="date_checked">Tanggal Diperiksa:</label>
            <input type="date" class="form-control @error('date_checked') is-invalid @enderror" id="date_checked"
              name="date_checked" value="{{ old('date_checked', $item->date_checked) }}">
            @error('date_checked')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="date_worked">Tanggal Dikerjakan:</label>
            <input type="date" class="form-control @error('date_worked') is-invalid @enderror" id="date_worked"
              name="date_worked" value="{{ old('date_worked', $item->date_worked) }}">
            @error('date_worked')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="date_completed">Tanggal Selesai:</label>
            <input type="date" class="form-control @error('date_completed') is-invalid @enderror"
              id="date_completed" name="date_completed" value="{{ old('date_completed', $item->date_completed) }}">
            @error('date_completed')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="date_picked">Tanggal Diambil:</label>
            <input type="date" class="form-control @error('date_picked') is-invalid @enderror" id="date_picked"
              name="date_picked" value="{{ old('date_picked', $item->date_picked) }}">
            @error('date_picked')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="technician">Teknisi:</label>
            <input type="text" class="form-control @error('technician') is-invalid @enderror" id="technician"
              name="technician" value="{{ old('technician', $item->technician) }}">
            @error('technician')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <h4 class="mb-0">Biaya</h4>
          <hr class="mt-0 mb-3">
          <div class="form-group">
            <label for="estimated_cost">Perkiraan Biaya:</label>
            <input type="text" class="form-control text-right @error('estimated_cost') is-invalid @enderror"
              id="estimated_cost" name="estimated_cost"
              value="{{ format_number(old('estimated_cost', $item->estimated_cost)) }}">
            @error('estimated_cost')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="down_payment">Uang Muka:</label>
            <input type="text" class="form-control text-right @error('down_payment') is-invalid @enderror"
              id="down_payment" name="down_payment"
              value="{{ format_number(old('down_payment', $item->down_payment)) }}">
            @error('down_payment')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="total_cost">Total Biaya:</label>
            <input type="text" class="form-control text-right @error('total_cost') is-invalid @enderror"
              id="total_cost" name="total_cost" value="{{ format_number(old('total_cost', $item->total_cost)) }}">
            @error('total_cost')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="payment_status">Status Pembayaran:</label>
            <select class="custom-select select2 form-control" id="payment_status" name="payment_status">
              <option value="{{ ServiceOrder::PAYMENT_STATUS_UNPAID }}"
                {{ $item->payment_status == ServiceOrder::PAYMENT_STATUS_UNPAID ? 'selected' : '' }}>
                {{ ServiceOrder::formatPaymentStatus(ServiceOrder::PAYMENT_STATUS_UNPAID) }}</option>
              <option value="{{ ServiceOrder::PAYMENT_STATUS_PARTIALLY_PAID }}"
                {{ $item->payment_status == ServiceOrder::PAYMENT_STATUS_PARTIALLY_PAID ? 'selected' : '' }}>
                {{ ServiceOrder::formatPaymentStatus(ServiceOrder::PAYMENT_STATUS_PARTIALLY_PAID) }}</option>
              <option value="{{ ServiceOrder::PAYMENT_STATUS_FULLY_PAID }}"
                {{ $item->payment_status == ServiceOrder::PAYMENT_STATUS_FULLY_PAID ? 'selected' : '' }}>
                {{ ServiceOrder::formatPaymentStatus(ServiceOrder::PAYMENT_STATUS_FULLY_PAID) }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="mb-0">Order</h4>
          <hr class="mt-0 mb-3">
          <div class="form-group">
            <label for="id">#No Order:</label>
            <input type="text" class="form-control" id="id" name=""
              value="{{ $item->id ? $item->idFormatted() : '-- otomatis --' }}" readonly>
          </div>
          <div class="form-group">
            <label for="order_status">Status:</label>
            <select class="custom-select select2 form-control" id="order_status" name="order_status">
              <option value="{{ ServiceOrder::ORDER_STATUS_ACTIVE }}"
                {{ $item->order_status == ServiceOrder::ORDER_STATUS_ACTIVE ? 'selected' : '' }}>
                {{ ServiceOrder::formatOrderStatus(ServiceOrder::ORDER_STATUS_ACTIVE) }}</option>
              <option value="{{ ServiceOrder::ORDER_STATUS_COMPLETED }}"
                {{ $item->order_status == ServiceOrder::ORDER_STATUS_COMPLETED ? 'selected' : '' }}>
                {{ ServiceOrder::formatOrderStatus(ServiceOrder::ORDER_STATUS_COMPLETED) }}</option>
              <option value="{{ ServiceOrder::ORDER_STATUS_CANCELED }}"
                {{ $item->order_status == ServiceOrder::ORDER_STATUS_CANCELED ? 'selected' : '' }}>
                {{ ServiceOrder::formatOrderStatus(ServiceOrder::ORDER_STATUS_CANCELED) }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="mb-0">Info Tambahan</h4>
          <hr class="mt-0 mb-3">
          <div class="form-group">
            <label for="notes">Catatan:</label>
            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes">{{ old('notes', $item->notes) }}</textarea>
            @error('notes')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
        </div> {{-- .card-body --}}
      </div>
    </div>
  </div>
@endSection

@section('footscript')
  <script>
    $(document).ready(function() {
      let customers = {!! json_encode($customers) !!};
      let customer_by_ids = {};
      customers.forEach(element => {
        customer_by_ids[element.id] = element;
      });

      $('.select2').select2();

      Inputmask("decimal", Object.assign({
        allowMinus: false
      }, INPUTMASK_OPTIONS)).mask("#down_payment,#estimated_cost,#total_cost");

      function on_customer_change() {
        const id = $('#customer_id').val();

        if (!id) {
          $('#customer_name').val('');
          $('#customer_phone').val('');
          $('#customer_address').val('');
          return;
        }

        let cust = customer_by_ids[id];
        $('#customer_name').val(cust.name);
        $('#customer_phone').val(cust.phone);
        $('#customer_address').val(cust.address);
      }

      $('#customer_id').change(function() {
        on_customer_change()
      });
    });
  </script>
@endsection
