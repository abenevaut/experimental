using System.Collections;
using UnityEngine;
using UnityEngine.UI;
using TMPro;
using UnityEngine.SceneManagement;

public class GameHandler : MonoBehaviour
{
    public gameBoard gBoard;

    public GameObject gWinner;

    void Awake()
    {
        closeWinnerPanel();
        gBoard.Build(this);
    }

    public void closeWinnerPanel()
    {
        gWinner.SetActive(false);
    }

    public void backToMenu()
    {
        SceneManager.LoadScene(SceneManager.GetActiveScene().buildIndex - 1);
    }

    public void EndGame(bool hasWinner)
    {
        TMP_Text winnerLabel = gWinner.GetComponentInChildren<TMP_Text>();

        winnerLabel.text = "Draw!";

        if (hasWinner) {
            winnerLabel.text = gBoard.GetTurnCharacter() + " Won!";
        }

        gWinner.SetActive(true);
        gBoard.Reset();
    }
}
