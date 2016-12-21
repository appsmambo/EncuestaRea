<?php

class HomeController extends BaseController {

	private $_anio = null;
	private $_semestre = null;
	private $_cicloAcademico = null;
	private $_messages = null;
	private $_rules = null;

	public function __construct()
	{
		$this->_anio = '2016';
		$this->_semestre = '2';
		$this->_cicloAcademico = CicloAcademico::where('anio', '=', $this->_anio)->where('semestre', '=', $this->_semestre)->firstOrFail();
		$this->_messages = array(
			'required'		=> 'El campo :attribute es obligatorio.',
			'min'			=> 'El campo :attribute debe tener mínimo :min letras.',
			'integer'		=> 'El campo :attribute solo permite números.',
			'alpha_num'		=> 'El campo :attribute solo permite letras y números.'
		);
		$this->_rules = array(
			'departamento_academico'		=> 'required',
			'codigo_salon'					=> 'required|min:4',
			'id_curso'						=> 'required',
			'seccion'						=> 'required',
			'nombre_rea'					=> 'required|min:4',
			'curso_contenido'				=> 'required|integer',
			'curso_exigencia'				=> 'required|integer',
			'curso_proposito'				=> 'required|integer',
			'alumno_esfuerzo'				=> 'required|integer',
			'alumno_actitud'				=> 'required|integer',
			'alumno_participacion'			=> 'required|integer',
			'profesor_motivacion'			=> 'required|integer',
			'profesor_tiempo'				=> 'required|integer',
			'profesor_contenido'			=> 'required|integer',
			'profesor_retroalimentacion'	=> 'required|integer'
		);
	}
	
	public function getIndex()
	{
		$departamentosAcademicos = DepartamentoAcademico::where('ciclo_academico', '=', $this->_cicloAcademico->id)->get()->toArray();
		return View::make('encuesta')->with('departamentosAcademicos', $departamentosAcademicos);
	}
	
	public function getGracias()
	{
		return View::make('gracias');
	}
	
	public function postConsultaDA()
	{
		$idDepartamentoAcademico = Input::get('id');
		// datos para salones
		$departamentoAcademico = DepartamentoAcademico::find($idDepartamentoAcademico);
		$salones = array(
			'prefijo' => $departamentoAcademico->prefijo,
			'cantidad' => $departamentoAcademico->cantidad_salones
		);
		// datos para cursos
		$cursos = Cursos::where('departamento_academico', '=', $idDepartamentoAcademico)->get(array('id', 'descripcion'))->toArray();
		// data
		$data = array(
			'salones' => $salones,
			'cursos' => $cursos
		);
		
		return json_encode($data);
	}
	
	public function postEncuesta()
	{
		$validator = Validator::make(Input::all(), $this->_rules, $this->_messages);
		
		if ($validator->fails()) {
			$messages = $validator->messages();
			$respuesta = array('status' => 'error', 'messages' => $messages);
		} else {
			DB::beginTransaction();
			try {
				$encuesta = new Encuesta;
				$encuesta->anio_academico				= $this->_anio;
				$encuesta->semestre						= $this->_semestre;
				$encuesta->departamento_academico		= Input::get('departamento_academico');
				$encuesta->codigo_salon					= Input::get('codigo_salon');
				$encuesta->id_curso						= Input::get('id_curso');
				$encuesta->seccion						= Input::get('seccion');
				$encuesta->nombre_rea					= Input::get('nombre_rea');
				$encuesta->curso_contenido				= Input::get('curso_contenido');
				$encuesta->curso_contenido_sustentacion = Input::get('curso_contenido_sustentacion');
				$encuesta->curso_exigencia				= Input::get('curso_exigencia');
				$encuesta->curso_exigencia_sustentacion = Input::get('curso_exigencia_sustentacion');
				$encuesta->curso_proposito				= Input::get('curso_proposito');
				$encuesta->curso_proposito_sustentacion = Input::get('curso_proposito_sustentacion');
				$encuesta->alumno_esfuerzo				= Input::get('alumno_esfuerzo');
				$encuesta->alumno_actitud				= Input::get('alumno_actitud');
				$encuesta->alumno_participacion			= Input::get('alumno_participacion');
				$encuesta->profesor_motivacion			= Input::get('profesor_motivacion');
				$encuesta->profesor_tiempo				= Input::get('profesor_tiempo');
				$encuesta->profesor_contenido			= Input::get('profesor_contenido');
				$encuesta->profesor_retroalimentacion	= Input::get('profesor_retroalimentacion');
				$encuesta->otros_1						= Input::get('otros_1');
				$encuesta->otros_2						= Input::get('otros_2');
				$encuesta->tiempo_encuesta				= Input::get('tiempo_encuesta');
				$encuesta->ip							= Funciones::getIp();
				$encuesta->save();
				$respuesta = array('status' => 'ok');
			} catch (ValidationException $e) {
				DB::rollback();
				$respuesta = array('status' => 'error', 'messages' => 'ValidationException');
			} catch (\Exception $e) {
				DB::rollback();
				$respuesta = array('status' => 'error', 'messages' => 'Exception');
			}
			DB::commit();
		}
		if ($respuesta['status'] === 'error')
			Log::info('Error al grabar los datos.', ['data' => Input::all(), 'msg' => $respuesta['messages']]);
		
		return Response::json($respuesta, 200);
	}

	public function getReporte()
	{
		return View::make('reporte');
	}
	public function postReporte()
	{
		/*
		 * 
		SELECT 
			DATE_FORMAT(e.created_at,'%d/%m/%Y  %H:%m:%s') AS 'fecha', 
			da.descripcion AS 'departamento academico', 
			e.codigo_salon AS 'salon', 
			c.descripcion AS 'curso', 
			e.seccion, 
			e.nombre_rea, 
			e.curso_contenido, 
			e.curso_contenido_sustentacion, 
			e.curso_exigencia, 
			e.curso_exigencia_sustentacion, 
			e.curso_proposito, 
			e.curso_proposito_sustentacion, 
			e.alumno_esfuerzo, 
			e.alumno_actitud, 
			e.alumno_participacion, 
			e.profesor_motivacion, 
			e.profesor_tiempo, 
			e.profesor_contenido, 
			e.profesor_retroalimentacion, 
			e.otros_1, 
			e.otros_2 
		FROM encuesta e 
		INNER JOIN departamento_academico da ON e.departamento_academico = da.id 
		INNER JOIN cursos c ON e.id_curso = c.id 
		ORDER BY fecha
		 *
		 */
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$datos = DB::table('encuesta')
					->select(
						DB::raw("DATE_FORMAT(encuesta.created_at,'%d/%m/%Y %H:%i:%s') AS 'fecha'"),
						DB::raw("departamento_academico.descripcion AS 'departamento academico'"),
						DB::raw("encuesta.codigo_salon AS 'salon'"),
						DB::raw("cursos.descripcion AS 'curso'"),
						'encuesta.seccion', 
						'encuesta.nombre_rea', 
						'encuesta.curso_contenido', 
						'encuesta.curso_contenido_sustentacion', 
						'encuesta.curso_exigencia', 
						'encuesta.curso_exigencia_sustentacion', 
						'encuesta.curso_proposito', 
						'encuesta.curso_proposito_sustentacion', 
						'encuesta.alumno_esfuerzo', 
						'encuesta.alumno_actitud', 
						'encuesta.alumno_participacion', 
						'encuesta.profesor_motivacion', 
						'encuesta.profesor_tiempo', 
						'encuesta.profesor_contenido', 
						'encuesta.profesor_retroalimentacion', 
						'encuesta.otros_1', 
						'encuesta.otros_2'
					)
					->join('departamento_academico', 'encuesta.departamento_academico', '=', 'departamento_academico.id')
					->join('cursos', 'encuesta.id_curso', '=', 'cursos.id')
					->orderBy('encuesta.created_at')->get();

		Excel::create('Reporte-Encuesta-REA', function($excel) use($datos) {
			$excel->sheet('Productos', function($sheet)  use($datos) {
				//$datos = Encuesta::select('id','created_at','anio_academico','semestre','departamento_academico')->get();
				//$sheet->fromModel($datos);
				$sheet->fromArray($datos);
			});
		})->export('xls');
	}
}
