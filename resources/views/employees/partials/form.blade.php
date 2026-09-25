{{-- resources/views/employees/partials/form.blade.php --}}
@php $e = $employee ?? null; @endphp

<ul class="nav nav-tabs" id="empTab" role="tablist">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-basic" type="button">Basic Info</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-job" type="button">Job Info</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-salary" type="button">Salary</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-bank" type="button">Bank / Mobile Banking</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-address" type="button">Address & Emergency</button></li>
</ul>

<div class="tab-content border border-top-0 p-3">

    {{-- BASIC INFO --}}
    <div class="tab-pane fade show active" id="tab-basic">
        <div class="row">
            <div class="col-md-3 mb-3 text-center">
                <img src="{{ $e?->photo_url ?? asset('vendor/adminlte/dist/img/user4-128x128.jpg') }}"
                     class="img-circle img-fluid mb-2" style="width:120px;height:120px;object-fit:cover;">
                <input type="file" name="photo" class="form-control form-control-sm" accept="image/*">
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $e->name ?? '') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name (বাংলা)</label>
                        <input type="text" name="name_bangla" class="form-control" value="{{ old('name_bangla', $e->name_bangla ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Father's Name</label>
                        <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $e->father_name ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Mother's Name</label>
                        <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name', $e->mother_name ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $e?->date_of_birth?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">NID No.</label>
                        <input type="text" name="nid_no" class="form-control @error('nid_no') is-invalid @enderror" value="{{ old('nid_no', $e->nid_no ?? '') }}">
                        @error('nid_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Birth Certificate No.</label>
                        <input type="text" name="birth_certificate_no" class="form-control" value="{{ old('birth_certificate_no', $e->birth_certificate_no ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                        <select name="gender" class="form-select" required>
                            @foreach (['Male','Female','Other'] as $g)
                                <option value="{{ $g }}" @selected(old('gender', $e->gender ?? '') === $g)>{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Blood Group</label>
                        <select name="blood_group" class="form-select">
                            <option value="">--</option>
                            @foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                                <option value="{{ $bg }}" @selected(old('blood_group', $e->blood_group ?? '') === $bg)>{{ $bg }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Marital Status</label>
                        <select name="marital_status" class="form-select">
                            <option value="">--</option>
                            @foreach (['Single','Married','Widowed','Divorced'] as $ms)
                                <option value="{{ $ms }}" @selected(old('marital_status', $e->marital_status ?? '') === $ms)>{{ $ms }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JOB INFO --}}
    <div class="tab-pane fade" id="tab-job">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Factory <span class="text-danger">*</span></label>
                <select name="factory_id" class="form-select" required>
                    @foreach ($factories as $f)
                        <option value="{{ $f->id }}" @selected(old('factory_id', $e->factory_id ?? '') == $f->id)>{{ $f->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Department <span class="text-danger">*</span></label>
                <select name="department_id" class="form-select" required>
                    @foreach ($departments as $d)
                        <option value="{{ $d->id }}" @selected(old('department_id', $e->department_id ?? '') == $d->id)>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Designation <span class="text-danger">*</span></label>
                <select name="designation_id" class="form-select" required>
                    @foreach ($designations as $d)
                        <option value="{{ $d->id }}" @selected(old('designation_id', $e->designation_id ?? '') == $d->id)>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Floor</label>
                <select name="floor_id" class="form-select">
                    <option value="">--</option>
                    @foreach ($floors as $f)
                        <option value="{{ $f->id }}" @selected(old('floor_id', $e->floor_id ?? '') == $f->id)>{{ $f->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Production Line</label>
                <select name="production_line_id" class="form-select">
                    <option value="">--</option>
                    @foreach ($lines as $l)
                        <option value="{{ $l->id }}" @selected(old('production_line_id', $e->production_line_id ?? '') == $l->id)>{{ $l->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Joining Date <span class="text-danger">*</span></label>
                <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', $e?->joining_date?->format('Y-m-d')) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Employee Type <span class="text-danger">*</span></label>
                <select name="employee_type" class="form-select" required>
                    @foreach (['Worker','Staff','Casual'] as $t)
                        <option value="{{ $t }}" @selected(old('employee_type', $e->employee_type ?? '') === $t)>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    @foreach (['Active','Resigned','Terminated','Layoff'] as $s)
                        <option value="{{ $s }}" @selected(old('status', $e->status ?? 'Active') === $s)>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            @if ($e)
            <div class="col-md-4 mb-3">
                <label class="form-label">Resign Date</label>
                <input type="date" name="resign_date" class="form-control" value="{{ old('resign_date', $e?->resign_date?->format('Y-m-d')) }}">
            </div>
            <div class="col-md-8 mb-3">
                <label class="form-label">Resign Reason</label>
                <input type="text" name="resign_reason" class="form-control" value="{{ old('resign_reason', $e->resign_reason ?? '') }}">
            </div>
            @endif
        </div>
    </div>

    {{-- SALARY --}}
    <div class="tab-pane fade" id="tab-salary">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Salary Type <span class="text-danger">*</span></label>
                <select name="salary_type" class="form-select" required>
                    @foreach (['Monthly','Daily','Piece Rate'] as $st)
                        <option value="{{ $st }}" @selected(old('salary_type', $e->salary_type ?? '') === $st)>{{ $st }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Basic Salary <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="basic_salary" class="form-control" value="{{ old('basic_salary', $e->basic_salary ?? 0) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">House Rent</label>
                <input type="number" step="0.01" name="house_rent" class="form-control" value="{{ old('house_rent', $e->house_rent ?? 0) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Medical Allowance</label>
                <input type="number" step="0.01" name="medical_allowance" class="form-control" value="{{ old('medical_allowance', $e->medical_allowance ?? 0) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Conveyance Allowance</label>
                <input type="number" step="0.01" name="conveyance_allowance" class="form-control" value="{{ old('conveyance_allowance', $e->conveyance_allowance ?? 0) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Food Allowance</label>
                <input type="number" step="0.01" name="food_allowance" class="form-control" value="{{ old('food_allowance', $e->food_allowance ?? 0) }}">
            </div>
        </div>
        <small class="text-muted">Gross salary is auto-calculated as the sum of all components above.</small>
    </div>

    {{-- BANK --}}
    <div class="tab-pane fade" id="tab-bank">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Bank Name</label>
                <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name', $e->bank_name ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Bank Account No.</label>
                <input type="text" name="bank_account_no" class="form-control" value="{{ old('bank_account_no', $e->bank_account_no ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Mobile Banking Type</label>
                <select name="mobile_banking_type" class="form-select">
                    <option value="">--</option>
                    @foreach (['bKash','Nagad','Rocket','Upay'] as $mb)
                        <option value="{{ $mb }}" @selected(old('mobile_banking_type', $e->mobile_banking_type ?? '') === $mb)>{{ $mb }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Mobile Banking No.</label>
                <input type="text" name="mobile_banking_no" class="form-control" value="{{ old('mobile_banking_no', $e->mobile_banking_no ?? '') }}">
            </div>
        </div>
    </div>

    {{-- ADDRESS --}}
    <div class="tab-pane fade" id="tab-address">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Present Address</label>
                <textarea name="present_address" class="form-control" rows="2">{{ old('present_address', $e->present_address ?? '') }}</textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Permanent Address</label>
                <textarea name="permanent_address" class="form-control" rows="2">{{ old('permanent_address', $e->permanent_address ?? '') }}</textarea>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $e->phone ?? '') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Emergency Contact Name</label>
                <input type="text" name="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name', $e->emergency_contact_name ?? '') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Emergency Contact Phone</label>
                <input type="text" name="emergency_contact_phone" class="form-control" value="{{ old('emergency_contact_phone', $e->emergency_contact_phone ?? '') }}">
            </div>
        </div>
    </div>

</div>
