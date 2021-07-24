function varargout = Skripsi(varargin)

% SKRIPSI MATLAB code for Skripsi.fig
%      SKRIPSI, by itself, creates a new SKRIPSI or raises the existing
%      singleton*.
%
%      H = SKRIPSI returns the handle to a new SKRIPSI or the handle to
%      the existing singleton*.
%
%      SKRIPSI('CALLBACK',hObject,eventData,handles,...) calls the local
%      function named CALLBACK in SKRIPSI.M with the given input arguments.
%
%      SKRIPSI('Property','Value',...) creates a new SKRIPSI or raises the
%      existing singleton*.  Starting from the left, property value pairs are
%      applied to the GUI before Skripsi_OpeningFcn gets called.  An
%      unrecognized property name or invalid value makes property application
%      stop.  All inputs are passed to Skripsi_OpeningFcn via varargin.
%
%      *See GUI Options on GUIDE's Tools menu.  Choose "GUI allows only one
%      instance to run (singleton)".
%
% See also: GUIDE, GUIDATA, GUIHANDLES

% Edit the above text to modify the response to help Skripsi

% Last Modified by GUIDE v2.5 04-Jan-2021 12:32:31

% Begin initialization code - DO NOT EDIT
gui_Singleton = 1;
gui_State = struct('gui_Name',       mfilename, ...
                   'gui_Singleton',  gui_Singleton, ...
                   'gui_OpeningFcn', @Skripsi_OpeningFcn, ...
                   'gui_OutputFcn',  @Skripsi_OutputFcn, ...
                   'gui_LayoutFcn',  [] , ...
                   'gui_Callback',   []);
if nargin && ischar(varargin{1})
    gui_State.gui_Callback = str2func(varargin{1});
end

if nargout
    [varargout{1:nargout}] = gui_mainfcn(gui_State, varargin{:});
else
    gui_mainfcn(gui_State, varargin{:});
end

% End initialization code - DO NOT EDIT


% --- Executes just before Skripsi is made visible.
function Skripsi_OpeningFcn(hObject, ~, handles, varargin)

% Choose default command line output for Skripsi
handles.output = hObject;

% Update handles structure
guidata(hObject, handles);

% UIWAIT makes Skripsi wait for user response (see UIRESUME)
% uiwait(handles.figure1);


% --- Outputs from this function are returned to the command line.
function varargout = Skripsi_OutputFcn(hObject, eventdata, handles) 

varargout{1} = handles.output;


% --- Executes on button press in caridata.
function bukadata_Callback(hObject, eventdata, handles)

[namaFile pathname] = uigetfile ({'*.xlsx'},'bukadata');
namaFile=fullfile(namaFile);
set(handles.namaFile,'String',namaFile);
guidata(hObject, handles);



function namaFile_Callback(hObject, eventdata, handles)

if ext == '.xlsx'
    if(exist(namaFile) == 0)
        set(hObject, 'String', 'namaFile.xlsx');
        errordlg('File tidak ada', 'Error');
    else
        handles.metricdata.namaFile = namaFile;
        guidata(hObject,handles)
    end
else
    set(hObject, 'String', 'namaFile.xlsx');
    errordlg('Nama File tidak valid', 'Error');
end




% --- Executes during object creation, after setting all properties.
function namaFile_CreateFcn(hObject, eventdata, handles)
%
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end


% --- Executes on button press in pushbutton2.
function pushbutton2_Callback(hObject, eventdata, handles)
% hObject    handle to pushbutton2 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)
warndlg('Proses Training memakan waktu beberapa menit!')
% proses normalisasi data
namaFile = get(handles.namaFile,'String');
global data;
global data_norm;
global tahun_latih;
global net_keluaran;
global max_data;
global min_data;
global net_keluaran_pso;
data = xlsread(namaFile);
data(:,1) = [];
tahun_latih=size(data,1)-2;
jumlah_bulan=size(data,2);
max_data = max(max(data));
min_data = min(min(data));

[m,n] = size(data);

%normalisasi Data
data_norm = zeros(m,n);
for x = 1:m
    for y = 1:n
        data_norm(x,y) = 0.1+0.8*(data(x,y)-min_data)/(max_data-min_data);
    end
end
% menyusun data dan target latih
data_norm = data_norm';
data_latih = zeros(12,jumlah_bulan*tahun_latih);

for n = 1:jumlah_bulan*tahun_latih
    for m = 1:jumlah_bulan
        data_latih(m,n) = data_norm(m+n);
    end
end

target_latih = data_norm(jumlah_bulan+1:jumlah_bulan*(tahun_latih+1));
jumlah_neuron1 = str2double(handles.hidden.String);
fungsi_aktivasi1 = 'logsig';
fungsi_aktivasi2 = 'logsig';
fungsi_pelatihan = 'traingd';

% membangun arsitektur backpropagation
net = newff(minmax(data_latih),[jumlah_neuron1 1],{fungsi_aktivasi1,...
    fungsi_aktivasi2},fungsi_pelatihan);

% menyiapkan parameter2 pelatihan (error goal, jumlah
% epoch, laju pembelajaran)
error_goal = str2double(handles.errg.String);
jumlah_epoch = str2double(handles.epoch.String);
laju_pembelajaran = str2double(handles.learnr.String);

net.trainParam.goal = error_goal;
net.trainParam.epochs = jumlah_epoch;
net.trainParam.lr = laju_pembelajaran;

% proses pelatihan (training)
net_keluaran = train(net,data_latih,target_latih);

% hasil pelatihan
hasil_latih = sim(net_keluaran,data_latih);

% penghitungan nilai MSE & MAPE
%MSE_latih = mse(net_keluaran,hasil_latih,target_latih);
mapelatih=mean(abs(hasil_latih -  target_latih)./target_latih)*100;
RMSE = sqrt(mean((target_latih - hasil_latih).^2));
%menampilkan RMSE dan MAPE latih BPNN
set(handles.tbm,'String',RMSE);
set(handles.mplatbp,'String',mapelatih);
%set(handles.rms,'String',RMSE);
%denormalisasi data hasil backpropagation
hasil_latih = ((hasil_latih-0.1)*(max_data-min_data)/0.8)+min_data;

target_latih_asli = data(2:5,:);	% 2015 s.d 2018
target_latih_asli = target_latih_asli';
target_latih_asli = target_latih_asli(:);

% PSO
r1p=str2double(handles.rsp.String);
r2p=str2double(handles.rdp.String);
iterpso=str2double(handles.iterpso.String);
pop=str2double(handles.pop.String);
%netp = newff(minmax(data_latih),[jumlah_neuron1 1],{fungsi_aktivasi1,fungsi_aktivasi2});
%netpso = configure(netp,data_latih,target_latih);
h = @(x) NMSE(x, net_keluaran, data_latih, target_latih);
k = jumlah_neuron1;
[x_pso, ~] = pso(h, 12*k+k+k+1,iterpso,pop,r1p,r2p);
net_keluaran_pso = setwb(net_keluaran, x_pso);
hasil_latih_pso = sim(net_keluaran_pso,data_latih);

% penghitungan nilai MSE 
%MSE_latih_pso = mse(hasil_latih_pso,target_latih);
mapelatihpso=mean(abs(hasil_latih_pso - target_latih)./target_latih)*100;
RMSE_latih_PSO = sqrt(mean((target_latih - hasil_latih_pso).^2));
%menampilkan RMSE latih PSO
set(handles.tbpm,'String',RMSE_latih_PSO);
set(handles.mplatbps,'String',mapelatihpso);
%menyimpan model training backprop pso
save latihpso.mat hasil_latih_pso
%denormalisasi data hasil latih backprop pso
hasil_latih_pso = ((hasil_latih_pso-...
    0.1)*(max_data-min_data)/0.8)+min_data;

% plot grafik keluaran latih dengan target
figure,
plot(target_latih_asli,'ro-','LineWidth',1)
hold on
plot(hasil_latih,'b*-','LineWidth',1)
plot(hasil_latih_pso,'g*-','LineWidth',1)
hold off
grid on
title('Grafik Keluaran Training Data')
h = gca;
h.XTick = [1:12:60];
h.XTickLabel = {'2014';'2015';'2016';'2017';'2018'};
xlabel('Tahun')
ylabel('IHK')
legend('Target','Backpropagation','Backpropagation+PSO','Location','Best')




function tbm_Callback(hObject, eventdata, handles)
% hObject    handle to tbm (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of tbm as text
%        str2double(get(hObject,'String')) returns contents of tbm as a double


% --- Executes during object creation, after setting all properties.
function tbm_CreateFcn(hObject, eventdata, handles)

if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function tbpm_Callback(hObject, eventdata, handles)
% hObject    handle to tbpm (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of tbpm as text
%        str2double(get(hObject,'String')) returns contents of tbpm as a double
% --- Executes during object creation, after setting all properties.
function tbpm_CreateFcn(hObject, eventdata, handles)
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end

function testbpm_Callback(hObject, eventdata, handles)
% hObject    handle to testbpm (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of testbpm as text
%        str2double(get(hObject,'String')) returns contents of testbpm as a double
% --- Executes during object creation, after setting all properties.
function testbpm_CreateFcn(hObject, eventdata, handles)

if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function testbm_Callback(hObject, eventdata, handles)
% hObject    handle to testbm (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of testbm as text
%        str2double(get(hObject,'String')) returns contents of testbm as a double


% --- Executes during object creation, after setting all properties.
function testbm_CreateFcn(hObject, eventdata, handles)

if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end


% --- Executes on button press in pushbutton3.
function pushbutton3_Callback(hObject, eventdata, handles)
global data;
global data_norm;
global tahun_latih;
global net_keluaran;
global max_data;
global min_data;
global net_keluaran_pso;
if exist('latihpso.mat','file')
% load jaringan yang sudah dibuat pada proses pelatihan
load latihpso.mat
% menyusun data dan target uji
tahun_uji = 1; % Januari 2019 s.d Desember 2019
jumlah_bulan = 12;
data_uji = zeros(12,jumlah_bulan*tahun_uji-1);

for n = 1:jumlah_bulan*tahun_uji
    for m = 1:jumlah_bulan
        data_uji(m,n) = data_norm(jumlah_bulan*tahun_latih+m+n);
    end
end
 
target_uji = data_norm(jumlah_bulan*(tahun_latih+tahun_uji)+1:end); % Januari 2019 s.d Desember 2019

% hasil pengujian Backpropagation
hasil_uji = sim(net_keluaran,data_uji);

% penghitungan nilai MSE & MAPE uji Backpropagation
%MSE_uji = mse(hasil_uji,target_uji);
mapeuji=mean(abs(hasil_uji-target_uji)/target_uji)*100;
RMSE_uji=sqrt(mean((target_uji - hasil_uji).^2));
%menampilkan MSE & MAPE uji BPNN
set(handles.testbm,'String',RMSE_uji);
set(handles.mptsb,'String',mapeuji);
hasil_uji = ((hasil_uji-...
    0.1)*(max_data-min_data)/0.8)+min_data;
target_uji_asli = data(6,:);	% 2019
target_uji_asli = target_uji_asli';
target_uji_asli = target_uji_asli(:);

% hasil pengujian PSO-BPNN
hasil_uji_pso = sim(net_keluaran_pso,data_uji);

% penghitungan MSE & MAPE PSO-BPNN
%MSE_uji_pso = mse(hasil_uji_pso,target_uji);
mapepsouji=mean(abs(hasil_uji_pso-target_uji)/target_uji)*100;
RMSE_uji_pso=sqrt(mean((target_uji - hasil_uji_pso).^2));
%menampilkan MSE & MAPE uji PSO-BPNN
set(handles.testbpm,'String',RMSE_uji_pso);
set(handles.mptsbps,'String',mapepsouji);

hasil_uji_pso = ((hasil_uji_pso-...
    0.1)*(max_data-min_data)/0.8)+min_data;

figure,
plot(target_uji_asli,'mo-','LineWidth',1)
hold on
plot(hasil_uji,'y*-','LineWidth',1)
plot(hasil_uji_pso,'c*-','LineWidth',1)
hold off
grid on
title('Grafik Keluaran Testing Data')
h = gca;
h.XTick = [1:12];
h.XTickLabel = {'JAN';'FEB';'MAR';'APR';'MEI';'JUN';...
    'JUL';'AGS';'SEP';'OKT';'NOV';'DES'};
xlabel('Tahun 2019')
ylabel('IHK')
legend('Target','Backpropagation','Backpropagation+PSO','Location','Best')
else 
    errordlg('Model training tidak di temukan, Lakukan training data terlebih dahulu!!!')
end


function input1_Callback(hObject, eventdata, handles)
% hObject    handle to input1 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input1 as text
%        str2double(get(hObject,'String')) returns contents of input1 as a double


% --- Executes during object creation, after setting all properties.
function input1_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input1 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input2_Callback(hObject, eventdata, handles)
% hObject    handle to input2 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input2 as text
%        str2double(get(hObject,'String')) returns contents of input2 as a double


% --- Executes during object creation, after setting all properties.
function input2_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input2 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input3_Callback(hObject, eventdata, handles)
% hObject    handle to input3 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input3 as text
%        str2double(get(hObject,'String')) returns contents of input3 as a double


% --- Executes during object creation, after setting all properties.
function input3_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input3 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input4_Callback(hObject, eventdata, handles)
% hObject    handle to input4 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input4 as text
%        str2double(get(hObject,'String')) returns contents of input4 as a double


% --- Executes during object creation, after setting all properties.
function input4_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input4 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input5_Callback(hObject, eventdata, handles)
% hObject    handle to input5 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input5 as text
%        str2double(get(hObject,'String')) returns contents of input5 as a double


% --- Executes during object creation, after setting all properties.
function input5_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input5 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input6_Callback(hObject, eventdata, handles)
% hObject    handle to input6 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input6 as text
%        str2double(get(hObject,'String')) returns contents of input6 as a double


% --- Executes during object creation, after setting all properties.
function input6_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input6 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input7_Callback(hObject, eventdata, handles)
% hObject    handle to input7 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input7 as text
%        str2double(get(hObject,'String')) returns contents of input7 as a double


% --- Executes during object creation, after setting all properties.
function input7_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input7 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input8_Callback(hObject, eventdata, handles)
% hObject    handle to input8 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input8 as text
%        str2double(get(hObject,'String')) returns contents of input8 as a double


% --- Executes during object creation, after setting all properties.
function input8_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input8 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input9_Callback(hObject, eventdata, handles)
% hObject    handle to input9 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input9 as text
%        str2double(get(hObject,'String')) returns contents of input9 as a double


% --- Executes during object creation, after setting all properties.
function input9_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input9 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input10_Callback(hObject, eventdata, handles)
% hObject    handle to input10 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input10 as text
%        str2double(get(hObject,'String')) returns contents of input10 as a double


% --- Executes during object creation, after setting all properties.
function input10_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input10 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input11_Callback(hObject, eventdata, handles)
% hObject    handle to input11 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input11 as text
%        str2double(get(hObject,'String')) returns contents of input11 as a double


% --- Executes during object creation, after setting all properties.
function input11_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input11 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function input12_Callback(hObject, eventdata, handles)
% hObject    handle to input12 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of input12 as text
%        str2double(get(hObject,'String')) returns contents of input12 as a double


% --- Executes during object creation, after setting all properties.
function input12_CreateFcn(hObject, eventdata, handles)
% hObject    handle to input12 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end


% --- Executes on button press in pushbutton4.
function pushbutton4_Callback(hObject, eventdata, handles)
% hObject    handle to pushbutton4 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)
global data;
global max_data;
global min_data;
global net_keluaran_pso;

x1=str2double(handles.input1.String); x2=str2double(handles.input2.String); x3=str2double(handles.input3.String);
x4=str2double(handles.input4.String); x5=str2double(handles.input5.String); x6=str2double(handles.input6.String);
x7=str2double(handles.input7.String); x8=str2double(handles.input8.String); x9=str2double(handles.input9.String);
x10=str2double(handles.input10.String);x11=str2double(handles.input11.String);x12=str2double(handles.input12.String);
datap=[x1,x2,x3,x4,x5,x6,x7,x8,x9,x10,x11,x12];

  
max_data = max(max(data));
min_data = min(min(data));
  
[m,n] = size(datap);

data_normp = zeros(m,n);
for x = 1:m
    for y = 1:n
        data_normp(x,y) = 0.1+0.8*(datap(x,y)-min_data)/(max_data-min_data);
    end
end

data_pred = reshape(data_normp,12,1);
 


hasil = sim(net_keluaran_pso,data_pred);
hasil = ((hasil-0.1)*(max_data-min_data)/0.8)+min_data;
set(handles.hasilp,'String',hasil);



function hasilp_Callback(hObject, eventdata, handles)
% hObject    handle to hasilp (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of hasilp as text
%        str2double(get(hObject,'String')) returns contents of hasilp as a double


% --- Executes during object creation, after setting all properties.
function hasilp_CreateFcn(hObject, eventdata, handles)
% hObject    handle to hasilp (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function mplatbp_Callback(hObject, eventdata, handles)
% hObject    handle to mplatbp (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of mplatbp as text
%        str2double(get(hObject,'String')) returns contents of mplatbp as a double


% --- Executes during object creation, after setting all properties.
function mplatbp_CreateFcn(hObject, eventdata, handles)
% hObject    handle to mplatbp (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end




function mptsb_Callback(hObject, eventdata, handles)
% hObject    handle to mptsb (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of mptsb as text
%        str2double(get(hObject,'String')) returns contents of mptsb as a double


% --- Executes during object creation, after setting all properties.
function mptsb_CreateFcn(hObject, eventdata, handles)
% hObject    handle to mptsb (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function mptsbps_Callback(hObject, eventdata, handles)
% hObject    handle to mptsbps (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of mptsbps as text
%        str2double(get(hObject,'String')) returns contents of mptsbps as a double


% --- Executes during object creation, after setting all properties.
function mptsbps_CreateFcn(hObject, eventdata, handles)
% hObject    handle to mptsbps (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function hidden_Callback(hObject, eventdata, handles)
% hObject    handle to hidden (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of hidden as text
%        str2double(get(hObject,'String')) returns contents of hidden as a double


% --- Executes during object creation, after setting all properties.
function hidden_CreateFcn(hObject, eventdata, handles)
% hObject    handle to hidden (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function learnr_Callback(hObject, eventdata, handles)
% hObject    handle to learnr (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of learnr as text
%        str2double(get(hObject,'String')) returns contents of learnr as a double


% --- Executes during object creation, after setting all properties.
function learnr_CreateFcn(hObject, eventdata, handles)
% hObject    handle to learnr (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function epoch_Callback(hObject, eventdata, handles)
% hObject    handle to epoch (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of epoch as text
%        str2double(get(hObject,'String')) returns contents of epoch as a double


% --- Executes during object creation, after setting all properties.
function epoch_CreateFcn(hObject, eventdata, handles)
% hObject    handle to epoch (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function errg_Callback(hObject, eventdata, handles)
% hObject    handle to errg (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of errg as text
%        str2double(get(hObject,'String')) returns contents of errg as a double


% --- Executes during object creation, after setting all properties.
function errg_CreateFcn(hObject, eventdata, handles)
% hObject    handle to errg (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function mplatbps_Callback(hObject, eventdata, handles)
% hObject    handle to mplatbps (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of mplatbps as text
%        str2double(get(hObject,'String')) returns contents of mplatbps as a double


% --- Executes during object creation, after setting all properties.
function mplatbps_CreateFcn(hObject, eventdata, handles)
% hObject    handle to mplatbps (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function edit37_Callback(hObject, eventdata, handles)
% hObject    handle to edit37 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of edit37 as text
%        str2double(get(hObject,'String')) returns contents of edit37 as a double


% --- Executes during object creation, after setting all properties.
function edit37_CreateFcn(hObject, eventdata, handles)
% hObject    handle to edit37 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function edit36_Callback(hObject, eventdata, handles)
% hObject    handle to edit36 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of edit36 as text
%        str2double(get(hObject,'String')) returns contents of edit36 as a double


% --- Executes during object creation, after setting all properties.
function edit36_CreateFcn(hObject, eventdata, handles)
% hObject    handle to edit36 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function edit35_Callback(hObject, eventdata, handles)
% hObject    handle to edit35 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of edit35 as text
%        str2double(get(hObject,'String')) returns contents of edit35 as a double


% --- Executes during object creation, after setting all properties.
function edit35_CreateFcn(hObject, eventdata, handles)
% hObject    handle to edit35 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function edit34_Callback(hObject, eventdata, handles)
% hObject    handle to edit34 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of edit34 as text
%        str2double(get(hObject,'String')) returns contents of edit34 as a double


% --- Executes during object creation, after setting all properties.
function edit34_CreateFcn(hObject, eventdata, handles)
% hObject    handle to edit34 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function rsp_Callback(hObject, eventdata, handles)
% hObject    handle to rsp (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of rsp as text
%        str2double(get(hObject,'String')) returns contents of rsp as a double


% --- Executes during object creation, after setting all properties.
function rsp_CreateFcn(hObject, eventdata, handles)
% hObject    handle to rsp (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function rdp_Callback(hObject, eventdata, handles)
% hObject    handle to rdp (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of rdp as text
%        str2double(get(hObject,'String')) returns contents of rdp as a double


% --- Executes during object creation, after setting all properties.
function rdp_CreateFcn(hObject, eventdata, handles)
% hObject    handle to rdp (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function iterpso_Callback(hObject, eventdata, handles)
% hObject    handle to iterpso (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of iterpso as text
%        str2double(get(hObject,'String')) returns contents of iterpso as a double


% --- Executes during object creation, after setting all properties.
function iterpso_CreateFcn(hObject, eventdata, handles)
% hObject    handle to iterpso (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function pop_Callback(hObject, eventdata, handles)
% hObject    handle to pop (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of pop as text
%        str2double(get(hObject,'String')) returns contents of pop as a double


% --- Executes during object creation, after setting all properties.
function pop_CreateFcn(hObject, eventdata, handles)
% hObject    handle to pop (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end



function rms_Callback(hObject, eventdata, handles)
% hObject    handle to rms (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of rms as text
%        str2double(get(hObject,'String')) returns contents of rms as a double


% --- Executes during object creation, after setting all properties.
function rms_CreateFcn(hObject, eventdata, handles)
% hObject    handle to rms (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end
