using UnityEngine;

public class gameBoard : MonoBehaviour
{
    public GameHandler game;

    public GameObject gameBoardCellPrefab;

    private gameBoardCell[] gbCells = new gameBoardCell[9];

    private bool mXTurn = true;

    private int mTurnCount = 0;

    public void Build(GameHandler gHandler)
    {
        for (int i = 0; i <= 8; i++) {
            GameObject newCell = Instantiate(gameBoardCellPrefab, transform);
            gbCells[i] = newCell.GetComponent<gameBoardCell>();
            gbCells[i].gBoard = this;
        }

        game = gHandler;
    }

    public void Reset()
    {
        mTurnCount = 0;

        foreach (gameBoardCell cell in gbCells) {
            cell.mLabel.text = "";
            cell.mButton.interactable = true;
        }
    }

    public void Switch()
    {
        bool hasWinner = CheckForWinner();

        mTurnCount++;

        if (hasWinner || mTurnCount == 9) {
            game.EndGame(hasWinner);

            return;
        }

        mXTurn = !mXTurn;
    }

    public string GetTurnCharacter()
    {
        return mXTurn ? "X" : "O";
    }

    public bool CheckForWinner()
    {
        int i = 0;

        // Horizontal
        for (i = 0; i <= 6; i += 3) {
            if (!CheckValues(i, i + 1) || !CheckValues(i, i + 2)) {
                continue;
            }

            return true;
        }

        // Vertical
        for (i = 0; i <= 2; i++) {
            if (!CheckValues(i, i + 3) || !CheckValues(i, i + 6)) {
                continue;
            }

            return true;
        }

        // Left Diagonal
        if (CheckValues(0, 4) && CheckValues(0, 8)) {
            return true;
        }

        // Right Diagonal
        if (CheckValues(2, 4) && CheckValues(2, 6)) {
            return true;
        }

        return false;
    }

    private bool CheckValues(int firstIndex, int secondIndex)
    {
        string firstValue = gbCells[firstIndex].mLabel.text;
        string secondValue = gbCells[secondIndex].mLabel.text;

        if (firstValue == "" || secondValue == "") {
            return false;
        }

        if (firstValue == secondValue) {
            return true;
        }

        return false;
    }
}
