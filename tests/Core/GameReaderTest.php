<?php

use App\Core\GameReader;
use PHPUnit\Framework\TestCase;

final class GameReaderTest extends TestCase
{
    /** @test */
    public function read_reading_a_valid_input_string_expected_three_pieces_output_separateley(): void
    {
        // Arrange
        $gameReader = new GameReader;
        $stdInputExample = __DIR__ . '/game_reader_mock_files/valid_output/round_later_than_first';

        // Act
        $pieces = $gameReader->read($stdInputExample);

        // Assert
        $this->assertEquals('3,100,2', $pieces['game_data']);
        $this->assertEquals('F-12:6-100,F-13:12-20,E-9:5-100,E-9:12-90', $pieces['map_state']);
        $this->assertEquals('123', $pieces['user_data']);
    }

    /** 
     * @test
     * @dataProvider firstRoundGameState
     *  */
    public function read_reading_a_valid_input_string_first_round_expected_three_pieces_output_but_user_data_empty(string $file): void
    {
        // Arrange
        $gameReader = new GameReader;
        $stdInputExample = __DIR__ . "/game_reader_mock_files/valid_output/$file";

        // Act
        $pieces = $gameReader->read($stdInputExample);

        // Assert
        $this->assertEquals('3,100,2', $pieces['game_data']);
        $this->assertEquals('F-12:6-100,F-13:12-20,E-9:5-100,E-9:12-90', $pieces['map_state']);
        $this->assertEquals('', $pieces['user_data']);
    }

    public function firstRoundGameState(): array
    {
        return [
            ['first_round_no_pound'],
            ['first_round_with_pound'],
        ];
    }

    /** @test */
    public function read_reading_a_valid_input_string_extended_user_data_expected_no_crash_and_state_read_accordingly(): void
    {
        // Arrange
        $gameReader = new GameReader;
        $stdInputExample = __DIR__ . '/game_reader_mock_files/valid_output/future_additional_data';

        // Act
        $pieces = $gameReader->read($stdInputExample);

        // Assert
        $this->assertEquals('25,100,1,123', $pieces['game_data']);
        $this->assertEquals('F-12:6-100,F-13:12-20,E-9:5-100,E-9:12-90', $pieces['map_state']);
        $this->assertEquals('something', $pieces['user_data']);
    }
}
